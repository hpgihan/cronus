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
