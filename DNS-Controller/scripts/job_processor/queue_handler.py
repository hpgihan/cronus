# Cronus is a Multi-Tenant virtualized PaaS solution developed by 
# Thinkcube Systems (Pvt) Ltd. Copyright (C) 2011 Thinkcube Systems (Pvt) Ltd.
#
# This file is part of Cronus.
#
# Cronus is free software: you can redistribute it and/or modify
# it under the terms of the GNU General Public License version 3  
# as published by the Free Software Foundation.
#
# Cronus is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with Cronus. If not; see <http://www.gnu.org/licenses/>.

import threading
import datetime
import os
import logging
import json
import urllib2
import urllib
import time
import MySQLdb
import hashlib

import config
import utils
import resolve

class QueueHandler:
    ''' Handles the Job Queue. Initiate jobs; assign deployments to the job 
    and then invokes the JobHandler '''
    def __init__(self):
        pass

    def start(self):
        if not os.path.exists('/var/log/cronus'):
            os.makedirs('/var/log/cronus')

        logger_error = logging.getLogger("error_log")
        eh = logging.FileHandler('/var/log/cronus/error.log')
        eh.setLevel(logging.DEBUG)
        logger_error.addHandler(eh)

        logger_activity = logging.getLogger("activity_log")
        ah = logging.FileHandler('/var/log/cronus/activity.log')
        ah.setLevel(logging.DEBUG)
        logger_activity.addHandler(ah)

        while 1:
            conn = MySQLdb.connect(host = config.dbhost, user = config.dbuser, passwd = config.dbpasswd, db = config.dbname)
            cursor = conn.cursor()
            # retrieve new jobs
            cursor.execute('SELECT * from job_queue WHERE status = 0')
            conn.commit()
            conn.close()

            job_rows = cursor.fetchall()

            if len(job_rows) == 0:
                print 'No jobs'
            else:
                # seperate jobs that should be executed and discarded
                job_rows, discarded_rows=resolve.resolve(job_rows)
                print 'No of resolved rows', len(job_rows)
                print 'No if discarded rows', len(discarded_rows)

                # set the executable job's status to 1 and invokes JobHandler. 
                # updates the job in the db to prevent QueueHandler picking the job again
                for job_row in job_rows:
                    job_id = job_row[0]
                    status = 1
                    deployment_sets = self.get_deployment_sets(job_id) 
                    job = Job(job_id, status, deployment_sets)
                    conn = MySQLdb.connect(host = config.dbhost, user = config.dbuser, passwd = config.dbpasswd, db = config.dbname)
                    cursor = conn.cursor()
                    cursor.execute("UPDATE job_queue SET status = 1 WHERE id = " + str(job_id))    
                    conn.commit()
                    conn.close()

                    jobhandler = JobHandler(job)
                    jobhandler.start()

                # set the discarded job's status to 4 and invokes JobHandler
                # updates the job in the db to prevent QueueHandler picking the job again
                for job_row in discarded_rows:
                    job_id = job_row[0]
                    status = 4
                    deployment_sets = self.get_deployment_sets(job_id) 
                    job = Job(job_id, status, deployment_sets)
                    conn = MySQLdb.connect(host = config.dbhost, user = config.dbuser, passwd = config.dbpasswd, db = config.dbname)
                    cursor = conn.cursor()
                    cursor.execute("UPDATE job_queue SET status = 1 WHERE id = " + str(job_id))    
                    conn.commit()
                    conn.close()

                    jobhandler = JobHandler(job)
                    jobhandler.start()

            time.sleep(60)

    def get_deployment_sets(self, job_id):
        ''' Returns the deployment sets of a given job '''
        conn = MySQLdb.connect(host = config.dbhost, user = config.dbuser, passwd = config.dbpasswd, db = config.dbname)
        cursor = conn.cursor()
        cursor.execute('SELECT DISTINCT(category) from deployment_queue WHERE job_id = ' + str(job_id))
        conn.commit()

        category_rows = cursor.fetchall()
        deployment_sets = []

        # create deployment sets
        for category_row in category_rows:
            category = category_row[0]
            cursor.execute("SELECT * from deployment_queue WHERE job_id = " + str(job_id) + " AND category = '" + category + "'")    
            conn.commit()

            deployment_rows = cursor.fetchall()
            deployments = []

            # assign deployments to a deployment set
            for deployment_row in deployment_rows:
                dep_id = deployment_row[0]
                category = deployment_row[2]
                url = deployment_row[3]
                values = deployment_row[4]
                dep_status = deployment_row[5]
                priority = deployment_row[6]   
                           
                deployments.append(Deployment(dep_id, category, url, values, dep_status, priority)) 

            deployment_sets.append(DeploymentSet(category, deployments))

        conn.close()
        return deployment_sets

class JobHandler(threading.Thread):
    ''' Handles a single job '''
    def __init__(self, job):
        threading.Thread.__init__(self)
        self.job = job

    def run(self):
        ''' If the status of the job is acknowledged, execute the job or
        if the status is discard discard the job '''
        if self.job.status == 1:
            self.execute()
        elif self.job.status == 4:
            self.discard()

    def execute(self):
        ''' Executes the deployments of the job '''
        print 'Executing for job ' + str(self.job.job_id)
        logger_error = logging.getLogger("error_log")
        logger_activity = logging.getLogger("activity_log")
        now = datetime.datetime.now()
        fail = False

        # order deployment sets according to the priority level. 
        self.job.deployment_sets.sort(key=lambda deployment_set: utils.priority_levels[deployment_set.category])

        for dep_set in self.job.deployment_sets:
            print 'executing for ' + dep_set.category
            # deployment sets that are in the critical priority level are only executed if all other sets are successfully executed
            if utils.priority_levels[dep_set.category] == utils.critical_priority and fail:
                print 'Job had failed. This category should be skipped'
                dep_set.skip()
                continue
            # within a deployment set sort the deployments according to the priority level
            dep_set.deployments.sort(key=lambda deployment: deployment.priority, reverse=True)
            for dep in dep_set.deployments:
                error=''
                print 'calling rest for ' + str(dep.dep_id)
                if dep.values:
                    params = urllib.urlencode(json.loads(dep.values))
                else:
                    params = None
                try:
                    print 'Calling - ' + dep.url
                    url = urllib.urlopen(dep.url, params)
                    res = url.read()
                    print 'Result - ' + res
                    url.close()
                    res_list = json.loads(res)
                    status = res_list['status']
                except IOError:
                    print 'Wrong url'
                    error='Invalid URL'
                    status = 'fail'
                except ValueError:
                    print 'Non json formatted response returned'
                    error='Non json value returned'
                    status = 'fail'
                except KeyError:
                    print 'Wrong json format returned'
                    error='Wrong json format returned'
                    status = 'fail'
                except:
                    print 'Unknown error occured while trying to call url'
                    error='Unknown error'
                    status = 'fail'

                if status == 'success':
                    print 'Deployment ' + str(dep.dep_id) + ' Successful'
                    logger_activity.error('[' + now.strftime("%Y-%m-%d %H:%M") + '] Deployment ' + str(dep.dep_id) + ' successful.')
                    dep.status = 3
                else:
                    fail = True
                    print 'Deployment ' + str(dep.dep_id) + ' failed'
                    logger_activity.error('[' + now.strftime("%Y-%m-%d %H:%M") + '] Deployment ' + str(dep.dep_id) + ' failed. - ' + error)
                    logger_error.error('[' + now.strftime("%Y-%m-%d %H:%M") + '] Deployment ' + str(dep.dep_id) + ' failed. - ' + error)
                    dep.status = 2
                    # if the deployment is in priority level 1 other deployments in the same deployment set are skipped
                    if dep.priority == 1:
                        print 'category should be skipped'
                        dep_set.skip(dep)
                        break

        # update job status
        if fail:
            logger_activity.error('[' + now.strftime("%Y-%m-%d %H:%M") + '] Job ' + str(self.job.job_id) + ' failed.')
            logger_error.error('[' + now.strftime("%Y-%m-%d %H:%M") + '] Job ' + str(self.job.job_id) + ' failed.')
            print ' Job ' + str(self.job.job_id) + ' failed'
            self.job.status = 2
        else:
            print ' Job ' + str(self.job.job_id) + ' successful'
            logger_activity.error('[' + now.strftime("%Y-%m-%d %H:%M") + '] Job ' + str(self.job.job_id) + ' successful')
            self.job.status = 3
        try:
            finalyze_url = config.job_finalyze_url + '/jobid/' + str(self.job.job_id) + '/status/' + str(self.job.status)
            hash_lib = hashlib.md5()
            hash_lib.update(config.api_key + '_' + finalyze_url)        
            token = hash_lib.hexdigest()
            params = urllib.urlencode(json.loads('{"token":"' + token + '"}'))
            print 'calling job finalyze call - ' + finalyze_url
            url = urllib2.urlopen(finalyze_url, params)
            res = url.read()
            url.close()
            print 'Result - ' + res
        except IOError:
            logger_activity.error('[' + now.strftime("%Y-%m-%d %H:%M") + '] Job ' + str(self.job.job_id) + ' finalyzing call failed.')
            logger_error.error('[' + now.strftime("%Y-%m-%d %H:%M") + '] Job ' + str(self.job.job_id) + ' finalyzing call failed.')
            print 'Wrong url. Job finalizing call failed'
        except:
            print 'Error calling URL. Job finalizing call failed'
            logger_activity.error('[' + now.strftime("%Y-%m-%d %H:%M") + '] Job ' + str(self.job.job_id) + ' finalyzing call failed.')
            logger_error.error('[' + now.strftime("%Y-%m-%d %H:%M") + '] Job ' + str(self.job.job_id) + ' finalyzing call failed.')

        logger_activity.error('[' + now.strftime("%Y-%m-%d %H:%M") + '] Job ' + str(self.job.job_id) + ' finalyzing call successful.')
        self.update()

    def update(self):
        ''' Updates the status of deployments and the job '''
        print 'updating for ' + str(self.job.job_id)
        logger_activity = logging.getLogger("activity_log")
        logger_error = logging.getLogger("error_log")
        conn = MySQLdb.connect(host = config.dbhost, user = config.dbuser, passwd = config.dbpasswd, db = config.dbname)
        cursor = conn.cursor()
        
        for dep_set in self.job.deployment_sets:
            for dep in dep_set.deployments:
                print str(dep.dep_id), dep.status
                cursor.execute("UPDATE deployment_queue SET status = " + str(dep.status) + " WHERE id = " + str(dep.dep_id))
                conn.commit()
                        
        cursor.execute("UPDATE job_queue SET status = " + str(self.job.status) + " WHERE id = " + str(self.job.job_id))
        conn.commit()            
        conn.close()

    def discard(self):
        ''' Set the status of deployments to skipped '''
        for dep_set in self.job.deployment_sets:
            for dep in dep_set.deployments:
                dep.status = 4

        self.update()
        

class Job:
    ''' Represents a Job '''
    def __init__(self, job_id, status, deployment_sets):
        self.job_id = job_id
        self.status = status
        self.deployment_sets = deployment_sets

class DeploymentSet:
    ''' Represents a set of deployments that belong to a same category '''
    def __init__(self, category, deployments):
            self.category = category
            self.deployments = deployments

    def skip(self, since=None):
        ''' skips the set of deployments. Optional since 
        specifies from where the deployments should be skipped. '''
        if not since:
            index_since = -1
        else:
            index_since = self.deployments.index(since)
        for dep in self.deployments[index_since+1:]:
            dep.status = 4

class Deployment:
    ''' Represents a deployment '''
    def __init__(self, dep_id, category, url, values, status, priority):
        self.dep_id = dep_id
        self.category = category
        self.url = url
        self.values = values
        self.status = status
        self.priority = priority

if __name__ == '__main__':
    print 'Run through job_processor.py'
