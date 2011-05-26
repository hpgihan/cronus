<?php

/*** Controller of the protocol ***/
include('inc/library.inc.php');

$_POST['token']="cc77781e4ed0528f4554197fc58c6e7a";
$auth = $_POST["token"];
//echo $auth;
$isvalid_url = check_integrity($auth);
$isvalid_url = true;

$arg = array();

if($_REQUEST['q']) {
    // Match URI components
    preg_match('/^([sc]\/)?([a-zA-Z0-9][a-zA-Z0-9\/\-+%.#!@^$*\s]*\/)?([a-zA-Z0-9-+%.#!@^$*\s]+)$/', $_REQUEST['q'], $m) or die('Bad URL') ;
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
    print json_encode(array('status'=>'fail'));
	}
}
else{
    print json_encode(array('status'=>'fail'));
}
