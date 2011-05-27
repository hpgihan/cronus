<?php

function create ($port, $diskquota) {
	global $shell_path;
	$retval = true;
	// Validate input
    if (! preg_match('/^\d+$/', $port))
        $retval = false;

	if ($retval) {
		exec("cd $shell_path && sudo ./platformdeploy create $port $diskquota", $output, $retval1);
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
		exec("cd $shell_path && sudo ./platformdeploy destroy $port", $output, $retval1);
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
		exec("cd $shell_path && sudo ./platformdeploy enable $port", $output, $retval1);
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
		exec("cd $shell_path && sudo ./platformdeploy disable $port", $output, $retval1);
        $retval = !$retval1;
	}
	
	return $retval;

}
