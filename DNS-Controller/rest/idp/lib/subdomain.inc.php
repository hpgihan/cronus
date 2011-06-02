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
