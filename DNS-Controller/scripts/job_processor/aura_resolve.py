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

import config

def resolve_package_toggle(rows):
    '''
    If a customers package changed in a sequence only the last package change is considered
        '''
    rows_list = list(rows)
    job_type_field = 1
    customer_id_field = 3
        
    for outer in range(len(rows)):
        for inner in range(outer+1, len(rows)):
            if(rows[outer][job_type_field] == config.job_type_package_change and
                    rows[inner][job_type_field] == config.job_type_package_change and 
                        rows[outer][customer_id_field] == rows[inner][customer_id_field]):

                # a -1 is inserted for jobs that should be discarded
                rows_list.pop(outer)
                rows_list.insert(outer,  -1)
                break
                    
    #inserted -1 are removed
    removable = -1
    to_be_removed = rows_list.count(removable)

    for index in range(to_be_removed):
        rows_list.remove(removable)
            
    return tuple(rows_list)

resolve_functions = [resolve_package_toggle, ]
