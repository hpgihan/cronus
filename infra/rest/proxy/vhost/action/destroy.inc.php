<?php

function _usage() {
	echo <<<EOT
Usage Example: /api/proxy/action/vhost/destroy/

subdomain : customer's host part of the subdomain 
domain : full domain name.
infraip : real ip address of the infrastructure server (my ip)

Returns: JSON {status:succss|fail}
EOT;
}

include ("$module/lib/$action_on.inc.php");
include ("$module/$action_on/config.php");
$retval = $function(param('domain'));
if($retval) {
	print json_encode(array('status'=>'success'));
} else {
	print json_encode(array('status'=>'fail'));
}


