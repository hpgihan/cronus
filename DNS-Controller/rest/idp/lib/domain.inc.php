<?php

function add($domain) {
	global $shell_path;
	$retval = true;

	if ($retval) {
		exec("cd $shell_path && sudo ./usermgmt add_domain $domain", $output, $retval1);
        	
        $retval = !$retval1;
	}
	
	return $retval;
}

function delete_domain($domain){
        global $shell_path;
        $retval = true;

        if ($retval) {
	        exec("cd $shell_path && sudo ./usermgmt delete_domain $domain", $output, $retval1);

            $retval = !$retval1;
        }

        return $retval;
}

?>
