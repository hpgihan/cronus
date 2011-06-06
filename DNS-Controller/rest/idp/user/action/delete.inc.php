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

<?php

/*
*
* Usage Example: /api/idp/action/user/delete
*
* passed values:
* subdomain : Customer's subdomain
* username : Customer's username
*
* Returns: JSON {status:success|fail}
*
*/

// Include helper lib file

include ("$module/lib/$action_on.inc.php");
include ("$module/$action_on/config.php");
//echo param('port').",".  param('subdomain').",".  param('domain').",".  param('infraip').",". param('webappip');
$retval = delete_user(param('subdomain'), param('username'));

if($retval) {
	print json_encode(array('status'=>'success'));
} else {
	print json_encode(array('status'=>'fail','message'=>'Invalid parameters or internal error.'));
}
