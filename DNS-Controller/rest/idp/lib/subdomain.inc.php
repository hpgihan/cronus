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
* Library functions for LDAP domain handling
*
*/

<?php

function add($subdomain) {
	global $shell_path;
	$retval = true;

	if ($retval) {
		exec("cd $shell_path && sudo ./usermgmt add-domain $subdomain", $output, $retval1);
        	
        $retval = !$retval1;
	}
	
	return $retval;
}

function delete_domain($subdomain){
        global $shell_path;
        $retval = true;

        if ($retval) {
	        exec("cd $shell_path && sudo ./usermgmt delete-domain $subdomain", $output, $retval1);

            $retval = !$retval1;
        }

        return $retval;
}

?>
