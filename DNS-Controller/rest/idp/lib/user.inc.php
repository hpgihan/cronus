<?php

function add($subdomain, $username, $lastname, $password) {
	global $shell_path;
	$retval = true;

	if ($retval) {
		exec("cd $shell_path && sudo ./usermgmt add $subdomain $username $lastname $password", $output, $retval1);
		exec("cd $shell_path && sudo ./myusermgmt add $username $password", $output, $retval2);
        	
		$retval = ! [[ $retval1 && $retval2 ]];
	}
	
	return $retval;
}

function delete_user($subdomain, $username){
        global $shell_path;
        $retval = true;

        if ($retval) {
            exec("cd $shell_path && sudo ./usermgmt delete $username", $output, $retval1);
	    exec("cd $shell_path && sudo ./myusermgmt delete $username", $output, $retval2);

            $retval = ! [[ $retval1 && $retval2 ]];
        }

        return $retval;
}
?>
