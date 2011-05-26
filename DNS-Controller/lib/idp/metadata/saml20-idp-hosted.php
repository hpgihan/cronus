<?php
/**
 * SAML IDP configuration data
 */

$metadata['platform-idp'] = array(
	'host' => '__DEFAULT__',

	/* X.509 key and certificate. Relative to the cert directory. */
	'privatekey' => 'server.pem',
	'certificate' => 'server.crt',

	/*
	 * Authentication source to use.
	 */
	'auth' => 'user-store',
);
