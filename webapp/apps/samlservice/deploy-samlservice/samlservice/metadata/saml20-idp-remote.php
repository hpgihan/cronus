<?php
/**
 *Configuration data for THINKCube SAML IDP 
 *
 */

$metadata['platform-idp'] = array (
'metadata-set' => 'saml20-idp-remote',
'entityid' => 'platform-idp',
'SingleSignOnService' => 'https://XXXIDPHOSTXXX/simplesaml/saml2/idp/SSOService.php',
'SingleLogoutService' => 'https://XXXIDPHOSTXXX/simplesaml/saml2/idp/SingleLogoutService.php',
'certData' => 'XXXIDPCERTXXX',
'NameIDFormat' => 'urn:oasis:names:tc:SAML:2.0:nameid-format:transient',
);
