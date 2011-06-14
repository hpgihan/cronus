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

dbhost = 'localhost'
dbuser = 'XXDBUSERXX'
dbpasswd = 'XXDBPASSXX'
dbname = 'cronus'

job_type_deploy = 1
job_type_package_change = 2
job_type_enable = 3
job_type_disable = 4
job_type_delete = 5

controller_ip='XXCNTRLIPXX'

job_finalyze_url = 'https://' + controller_ip + '/api/utils/action/job/update'

api_key='ca899e52f5d93bb1cdb623970c894f4cd17eeb3ea752e48a74bbacdb9ef18c08'
