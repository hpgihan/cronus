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


// Controller of the protocol
include('inc/config.inc.php');
include('inc/library.inc.php');

$auth = $_POST["token"];
$isvalid_url = check_integrity($auth);

$arg = array();

if($_REQUEST['q']) {
    // Match URI components
    preg_match('/^([sc]\/)?([a-zA-Z0-9][a-zA-Z0-9\/\-+%._#!@^$*\s]*\/)?([a-zA-Z0-9-+%._#!@^$*\s]+)$/', $_REQUEST['q'], $m) or die('Bad URL') ;
}
// Extract URI components
$p = preg_split('/\//', $m[0]);

$module = array_shift($p);
$action = array_shift($p);
$action_on = array_shift($p);
$function = array_shift($p);
assign_parameters($p);

if($isvalid_url){
	foreach ($_POST as $k=>$v) {
	    _insert_parameters($k, $v);
	}
    $source = "$module/$action_on/$action/$function.inc.php";

    global $arg;
	if (file_exists($source)) {
		include($source);
	}
	else{
    print json_encode(array('status'=>'fail','message'=>'Invalid API call.'));
	}
}
else{
    print json_encode(array('status'=>'fail','message'=>'Invalid API key.'));
}
