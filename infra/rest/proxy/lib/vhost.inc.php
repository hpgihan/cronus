<?php

function create ($domain, $port, $webappip) {
	global $shell_path;
	$retval = true;
	# Validate input
	if (! preg_match('/^\d+$/', $port))
		$retval = false;

	if (! preg_match('/^[a-z][a-z0-9_\.]+[a-z]{2,3}$/i', $domain))
		$retval = false;

	if (! preg_match('/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/', $webappip))
		$retval = false;

	if ($retval) {
		exec("cd $shell_path && sudo ./modproxy create $domain $port $webappip", $output, $retval1);
        $retval = !$retval1;
	}
	
	return $retval;
}

// Destroy infra deployment
function destroy ($domain) {
	global $shell_path;

	$retval = true;

	// Validate input
	if (! preg_match('/^[a-z][a-z0-9_\.]+[a-z]{2,3}$/i', $domain))
		$retval = false;

	if ($retval) {
		exec("cd $shell_path && sudo ./modproxy destroy $domain", $output, $retval1);
        $retval = !$retval1;
	}
	
	return $retval;

}

function reset(){
	global $shell_path;

	exec("cd $shell_path && sudo ./modproxy reset", $output, $retval1);
    $retval = !$retval1;
	return $retval;	
}
