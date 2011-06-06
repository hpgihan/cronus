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
* Library functions for IDP user handling
*
*/

<?php

// IDP User add
function add($subdomain, $username, $lastname, $password) {
	global $shell_path;
	$retval = true;

	if ($retval) {
		//exec("cd $shell_path && sudo ./usermgmt add $subdomain $username $lastname $password", $output, $retval1);
		exec("cd $shell_path && sudo ./myusermgmt add $username $password", $output, $retval2);
        	
		//$retval = ! [[ $retval1 && $retval2 ]];
        $retval = !$retval2;
	}
	
	return $retval;
}

// IDP user delete
function delete_user($subdomain, $username){
        global $shell_path;
        $retval = true;

        if ($retval) {
            //exec("cd $shell_path && sudo ./usermgmt delete $username", $output, $retval1);
	    exec("cd $shell_path && sudo ./myusermgmt delete $username", $output, $retval2);

            //$retval = ! [[ $retval1 && $retval2 ]];
            $retval = !$retval2;
        }

        return $retval;
}

// Change password
function change_passwd($subdomain, $username, $password){
        global $shell_path;
        $retval = true;

        if ($retval) {
            //exec("cd $shell_path && sudo ./usermgmt delete $username", $output, $retval1);
	        exec("cd $shell_path && sudo ./myusermgmt change-passwd $username $password", $output, $retval2);

            //$retval = ! [[ $retval1 && $retval2 ]];
            $retval = !$retval2;
        }

        return $retval;
       
}
?>
