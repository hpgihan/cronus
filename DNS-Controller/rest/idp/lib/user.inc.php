<?php

function add($username, $password) {
	global $shell_path;
	$retval = true;

	if ($retval) {
		exec("cd $shell_path && sudo ./usermgmt add $username $password", $output, $retval1);
        $retval = !$retval1;
	}
	
	return $retval;
}

function delete_user($username){
        global $shell_path;
        $retval = true;
        if ($retval) {
            exec("cd $shell_path && sudo ./usermgmt delete $username", $output, $retval1);
            $retval = !$retval1;
        }

        return $retval;

}
?>
