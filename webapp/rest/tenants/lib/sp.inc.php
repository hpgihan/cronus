<?php

# create saml provider
function create ($port, $domain, $idphost, $idpcert) {
	global $shell_path;
	$retval = true;
	// Validate input
    if (! preg_match('/^\d+$/', $port))
        $retval = false;

	if ($retval) {
		exec("cd $shell_path && sudo samlservice/samlservice create $port $domain $idphost $idpcert", $output, $retval1);
        $retval = !$retval1;
	}
	
	return $retval;
}

# Destroy saml provider
/*
function destroy($subdomain, $infraip, $webappip) {
	global $config;

	$retval = true;

	// Validate input
	if (! preg_match('/^[a-z][a-z0-9_]+$/', $subdomain))
		$retval = false;

	if (! preg_match('/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/', $infraip))
		$retval = false;

	if (! preg_match('/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/', $webappip))
		$retval = false;

	if ($retval) {
		$retval = exec("sudo ../shell/dns delete $subdomain $infraip $webappip");
	}
	
	return $retval;

}*/
