<?php

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

/*
*
* Disk usage summary of a tenant
*
* Usage Example: /api/tenants/query/tenant/diskusage
*
* passed values:
* port : Port assigned to tenant
*
* Returns: JSON {status:success|fail}
*
*/

include ("$module/lib/$action_on.inc.php");
include ("$module/$action_on/config.php");

$retval = $function(param('port'));

if($retval) {
	print json_encode($retval);
} else {
	print json_encode(array('status'=>'fail'));
}

