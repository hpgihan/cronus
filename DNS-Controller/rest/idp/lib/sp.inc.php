<?php

function add($domain) {
	global $shell_path;
	$retval = true;
	// Validate input
	if (! preg_match('/^[a-z][a-z0-9_\.]+[a-z]{2,3}$/i', $domain))
		$retval = false;

	if ($retval) {
		exec("cd $shell_path && sudo ./samlprovider add $domain", $output, $retval1);
        $retval = !$retval1;
	}
	
	return $retval;
}

function delete_sp($domain){
        global $shell_path;
        $retval = true;
        // Validate input
        if (! preg_match('/^[a-z][a-z0-9_\.]+[a-z]{2,3}$/i', $domain))
                $retval = false;

        if ($retval) {
                exec("cd $shell_path && sudo ./samlprovider delete $domain", $output, $retval1);
                $retval = !$retval1;
        }

        return $retval;

}
?>
