<?php

function update ($jobid) {
	global $shell_path;
	$retval = true;
	// Validate input
	if (! preg_match('/^[a-z][a-z0-9_]+$/', $subdomain))
		$retval = false;

	if ($retval) {
		exec("cd $shell_path && sudo ./dns add $subdomain $infraip $webappip", $output, $retval1);
        $retval = !$retval1;
	}
	
	return $retval;
}
?>
