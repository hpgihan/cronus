<?php

function _usage() {
	echo <<<EOT
Usage Example: /http://localhost/api/infra/operation/modproxy/change/

port : 8081 is customer's webapp server port
subdomain : customer's host part of the subdomain
domain : full domain name.
infraip : real ip address of the infrastructure server (my ip)
webappip : ip address of webapp server where the customer resides

Returns: JSON {status:succss|fail}
EOT;
}

include ("$module/lib/$action_on.inc.php");
include ("$module/$action_on/config.php");
$retval = change_domain(param('port'), param('domain'), param('infraip'), param('webappip'), param('subdomain'));

if($retval) {
	print json_encode(array('status'=>'success'));
} else {
	print json_encode(array('status'=>'fail'));
}

