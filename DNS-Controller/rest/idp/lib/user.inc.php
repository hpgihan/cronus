<?php

function add($username, $password, $lastname) {
	global $shell_path;
	$retval = true;

	if ($retval) {
		//exec("cd $shell_path && sudo ./usermgmt add $username $password $lastname", $output, $retval1);
		exec("cd $shell_path && sudo ./myusermgmt add $username $password", $output, $retval2);
        	
		//$retval = ! [[ $retval1 && $retval2 ]];
        $retval = !$retval2;
	}
	
	return $retval;
}

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
