<?php

function _usage() {
	echo <<<EOT
Usage Example: /api/idp/operation/user/delete

passed values:
port : 8081 is customer's webapp server port
domain : full domain name.
subdomain : customer's host part of the subdomain 
infraip : real ip address of the infrastructure server (my ip)
webappip : ip address of webapp server where the customer resides

Returns: JSON {status:success|fail}
EOT;
}

include ("$module/lib/$action_on.inc.php");
include ("$action_on/config.php");
//echo param('port').",".  param('subdomain').",".  param('domain').",".  param('infraip').",". param('webappip');
$retval = delete_user(param('username'));

if($retval) {
	print json_encode(array('status'=>'success'));
} else {
	print json_encode(array('status'=>'fail'));
}
