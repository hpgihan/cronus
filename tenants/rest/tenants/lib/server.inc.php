<?php

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

/*
*
* Helper library functions
*
*/

// Get server disk usage
function diskusage() {
    global $config;

	exec("cd $shell_path && sudo zfs list -H | head -n 1", $retval);

	# Return if command failed
	if (!$retval)
		return false;

	$outarr = array();

	foreach ($retval as $line) {
		list($mount, $used, $free) = preg_split("/\t/", $line);
		$unit = preg_replace('/[^KMGT]/', '', $used);
		$used = preg_replace('/[KMGT]/', '', $used);
		if($unit == 'M')
			$used *= 1000;
		elseif ($unit == 'G')
			$used *=  1000000;
		else $used;

		$unit = preg_replace('/[^KMGT]/', '', $free);
		$free = preg_replace('/[KMGT]/', '', $free);
		
		if($unit == 'M')
			$free *= 1000;
		elseif($unit == 'G')
			$free *= 1000000;
		else $free;
		
		array_push ($outarr, array('mount' => $mount, 'used' => $used, 'free' => $free));
	}

    return $outarr;
}
