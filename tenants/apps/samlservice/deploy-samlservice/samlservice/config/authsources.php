<?php

$config = array(

	// This is a authentication source which handles admin authentication.
	'admin' => array(
		// The default is to use core:AdminPassword, but it can be replaced with
		// any authentication source.

		'core:AdminPassword',
	),

	// An authentication source which can authenticate against both SAML 2.0
	// and Shibboleth 1.3 IdPs.
	'sp' => array(
	    'saml:SP',
		'entityID' => 'XXXDOMAINXXX',
        'idp' => 'cronus-idp',
		#'privatekey' => 'sp.pem',
		#'certificate' => 'sp.crt',
	),
);
