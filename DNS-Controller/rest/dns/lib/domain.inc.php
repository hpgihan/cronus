# Cronus is a Multi-Tenant virtualized PaaS solution developed by 
# Thinkcube Systems (Pvt) Ltd. Copyright (C) 2011 Thinkcube Systems (Pvt) Ltd.
#
# This file is part of Cronus.
#
# Cronus is free software: you can redistribute it and/or modify
# it under the terms of the GNU General Public License version 3  
# as published by the Free Software Foundation.
#
# Cronus is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with Cronus. If not; see <http://www.gnu.org/licenses/>.

<?php

function add ($subdomain, $infraip, $webappip) {
	global $shell_path;
	$retval = true;
	// Validate input
	if (! preg_match('/^[a-z][a-z0-9_]+$/', $subdomain))
		$retval = false;

	if (! preg_match('/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/', $infraip))
		$retval = false;

	if (! preg_match('/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/', $webappip))
		$retval = false;

	if ($retval) {
		exec("cd $shell_path && sudo ./dns add $subdomain $infraip $webappip", $output, $retval1);
        $retval = !$retval1;
	}
	
	return $retval;
}

function basicadd($subdomain, $infraip, $webappip){
        global $shell_path;
        $retval = true;
        // Validate input
        if (! preg_match('/^[a-z][a-z0-9_]+$/', $subdomain))
                $retval = false;

        if (! preg_match('/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/', $infraip))
                $retval = false;

        if (! preg_match('/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/', $webappip))
                $retval = false;

        if ($retval) {
                exec("cd $shell_path && sudo ./dns basicadd $subdomain $infraip $webappip", $output, $retval1);
                $retval = !$retval1;
        }

        return $retval;

}

// Destroy infra deployment
function delete_dns($subdomain, $infraip, $webappip) {
	global $shell_path;

	$retval = true;

	// Validate input
	if (! preg_match('/^[a-z][a-z0-9_]+$/', $subdomain))
		$retval = false;

	if (! preg_match('/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/', $infraip))
		$retval = false;

	if (! preg_match('/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/', $webappip))
		$retval = false;

	if ($retval) {
		exec("cd $shell_path && sudo ./dns delete $subdomain $infraip $webappip", $output, $retval1);
        $retval = !$retval1;
	}
	
	return $retval;

}

// Destroy basic deployment
function basicdelete($subdomain, $infraip, $webappip){
	global $shell_path;

	$retval = true;

	// Validate input
	if (! preg_match('/^[a-z][a-z0-9_]+$/', $subdomain))
		$retval = false;

	if (! preg_match('/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/', $infraip))
		$retval = false;

	if (! preg_match('/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/', $webappip))
		$retval = false;

	if ($retval) {
		exec("sudo ../shell/dns basicdelete $subdomain $infraip $webappip", $output, $retval1);
        $retval = !$retval1;
	}
	
	return $retval;
}

/*function change_domain($domain, $infraip, $webappip, $subdomain){
	global $config;

	$retval = true;
        $subdomain = 'blank';
        
	// Validate input
	if (! preg_match('/^\d+$/', $port))
		$retval = false;

	if (! preg_match('/^[a-z][a-z0-9_\.]+[a-z]{2,3}$/i', $domain))
		$retval = false;

	if (! preg_match('/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/', $infraip))
		$retval = false;

	if ($retval) {
		$retval = exec("sudo ../../shell/dns changedomain $port $subdomain $domain $infraip $webappip");
	}
	
	return $retval;
}*/
