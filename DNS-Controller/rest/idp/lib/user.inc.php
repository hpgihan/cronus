<?php

function add($subdomain, $username, $lastname, $password) {
	global $shell_path;
	$retval = true;

	if ($retval) {
		exec("cd $shell_path && sudo ./usermgmt add $subdomain $username $lastname $password", $output, $retval1);
        $retval = !$retval1;
	}
	
	return $retval;
}

function delete_user($subdomain, $username){
        global $shell_path;
        $retval = true;
        if ($retval) {
            exec("cd $shell_path && sudo ./usermgmt delete $subdomain $username", $output, $retval1);
            $retval = !$retval1;
        }

        return $retval;

}
?>
