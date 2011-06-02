import threading
import datetime
import subprocess
import logging
import time
import MySQLdb
import os

import config

class PollHandler:
    ''' Handles polling of servers. Assigns servers to Pollers '''
    def __init__(self):
        pass

    def start(self):
        if not os.path.exists('/var/log/cronus'):
            os.makedirs('/var/log/cronus')

        logger_activity = logging.getLogger("activity_log")
        ah = logging.FileHandler('/var/log/cronus/server_status.log')
        ah.setLevel(logging.DEBUG)
        logger_activity.addHandler(ah)

        while 1:
            conn = MySQLdb.connect(host = config.dbhost, user = config.dbuser, passwd = config.dbpasswd, db = config.dbname)
            cursor = conn.cursor()
            # retrieve servers 
            cursor.execute('SELECT * from tcvm_app_server')
            conn.commit()
            conn.close()

            server_rows = cursor.fetchall()

            if len(server_rows) == 0:
                print 'No servers to poll'
            else:
                # for every server create a Poller and passes the server to the poller
                for server_row in server_rows:
                    server = Server(server_row[0], server_row[1], server_row[2], server_row[6], server_row[7])
                    poller = Poller(server)
                    poller.start()  

            time.sleep(60)

class Poller(threading.Thread):
    ''' Polls a assigned server and updates '''
    def __init__(self, server):
        threading.Thread.__init__(self)
        self.server = server

    def run(self):
        self.poll()

    def poll(self):
        # ping the ip 3 times; truncate output
        ret = subprocess.call("ping -c 3 %s" % self.server.ip, shell=True, stdout=open('/dev/null', 'w'), stderr=subprocess.STDOUT)
        logger_activity = logging.getLogger("activity_log")
        now = datetime.datetime.now()
        # if server down
        if ret:
            print self.server.ip, 'down'
            # if server had been up and now down log it
            if self.server.status == config.SERVER_STATUS_UP:
                print 'Server ' + self.server.ip + ' is DOWN'
                logger_activity.error('[' + now.strftime("%Y-%m-%d %H:%M") + '] ' + ' Server ' + self.server.ip + ' of cluster ' + str(self.server.cluster_id) + ' is DOWN')
            self.server.status = config.SERVER_STATUS_DOWN
        # if server up
        else:
            print self.server.ip, 'up' 
            # if server had been down and now up log it
            if self.server.status == config.SERVER_STATUS_DOWN:
                print 'Server ' + self.server.ip + ' UP'
                logger_activity.error('[' + now.strftime("%Y-%m-%d %H:%M") + '] ' + ' Server ' + self.server.ip + ' of cluster ' + str(self.server.cluster_id) + ' is UP')
            self.server.status = config.SERVER_STATUS_UP
            
        self.update() 

    def update(self):
        ''' Update server status '''
        conn = MySQLdb.connect(host = config.dbhost, user = config.dbuser, passwd = config.dbpasswd, db = config.dbname)
        cursor = conn.cursor()
        cursor.execute('UPDATE tcvm_app_server SET status = ' + str(self.server.status) + ' WHERE id = ' + str(self.server.server_id))
        conn.commit()
        conn.close()

class Server:
    ''' Represents a server '''
    def __init__(self, server_id, ip, server_type, status, cluster_id):
        self.server_id = server_id
        self.ip = ip
        self.server_type = server_type
        self.status = int(status)
        self.cluster_id = cluster_id


if __name__ == '__main__':
    print 'Run through sever_poller.py'
