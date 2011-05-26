<?php

function _usage() {
	echo <<<EOT
Usage Example: /api/proxy/operation/vhost/create/

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
//$retval = create(param('port'), param('domain'), param('webappip'));
$retval = $function(param('domain'), param('port'), param('webappip'));

if($retval) {
	print json_encode(array('status'=>'success'));
} else {
	print json_encode(array('status'=>'fail'));
}

