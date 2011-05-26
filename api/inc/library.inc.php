<?php

// Insert value for key to param
function _insert_parameters($k, $v) {
    global $arg;

    if ($arg["$k"] && is_array($arg["$k"])) {
        // Push to existing array
        array_push($arg["$k"], $v);
    } elseif($arg["$k"]) {
        // Duplicate key so treat as sub array
        $vv = $arg["$k"];
        $arg["$k"] = array();
        array_push($arg["$k"], $vv);
        array_push($arg["$k"], $v);
    } else {
        $arg["$k"] = $v;
    }
}

// Assign parameters to arg array
function assign_parameters($params_array) {
    while(count($params_array)) {
        $k = array_shift($params_array);
        $v = array_shift($params_array);

        _insert_parameters($k, $v);
    }
}

// Returns parameter value
function param($k){
	global $arg;

	return (isset($arg[$k])) ? $arg[$k] : FALSE;
}

// Function to check integrity of url
function check_integrity($auth){

	$key = 'ca899e52f5d93bb1cdb623970c894f4cd17eeb3ea752e48a74bbacdb9ef18c08';

	$request = $_SERVER['REQUEST_URI'];
	$request =str_replace("/$auth", "", "$request");echo "<br>";
	$server = $_SERVER['SERVER_NAME'];
	$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5)) =='https'? 'https' : 'http';

	$url = $protocol."://".$server.$request;

	$newauth = md5($key."_".$url);

	if($newauth == $auth){
		return true;
	}
	else{
		return false;
	}

}