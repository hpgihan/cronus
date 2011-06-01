<?php

function create ($port, $diskquota) {
	global $shell_path;
	$retval = true;
	// Validate input
    if (! preg_match('/^\d+$/', $port))
        $retval = false;

	if ($retval) {
		exec("cd $shell_path && sudo ./cronusdeploy create $port $diskquota", $output, $retval1);
        $retval = !$retval1;
	}
	
	return $retval;
}

// Destroy infra deployment
function destroy($port) {
	global $shell_path;

	$retval = true;

	// Validate input
    if (! preg_match('/^\d+$/', $port))
        $retval = false;

	if ($retval) {
		exec("cd $shell_path && sudo ./cronusdeploy destroy $port", $output, $retval1);
        $retval = !$retval1;
	}
	
	return $retval;

}

function enable($port) {
	global $shell_path;

	$retval = true;

	// Validate input
    if (! preg_match('/^\d+$/', $port))
        $retval = false;

	if ($retval) {
		exec("cd $shell_path && sudo ./cronusdeploy enable $port", $output, $retval1);
        $retval = !$retval1;
	}
	
	return $retval;

}

function disable($port) {
	global $shell_path;

	$retval = true;

	// Validate input
    if (! preg_match('/^\d+$/', $port))
        $retval = false;

	if ($retval) {
		exec("cd $shell_path && sudo ./cronusdeploy disable $port", $output, $retval1);
        $retval = !$retval1;
	}
	
	return $retval;

}
