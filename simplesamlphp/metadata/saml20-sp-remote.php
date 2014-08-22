<?php
/**
 * SAML 2.0 remote SP metadata for simpleSAMLphp.
 *
 * See: http://simplesamlphp.org/docs/trunk/simplesamlphp-reference-sp-remote
 */

/*
 * Example simpleSAMLphp SAML 2.0 SP
 */
$metadata['https://saml2sp.example.org'] = array(
	'AssertionConsumerService' => 'https://saml2sp.example.org/simplesaml/module.php/saml/sp/saml2-acs.php/default-sp',
	'SingleLogoutService' => 'https://saml2sp.example.org/simplesaml/module.php/saml/sp/saml2-logout.php/default-sp',
);

/*
 * This example shows an example config that works with Google Apps for education.
 * What is important is that you have an attribute in your IdP that maps to the local part of the email address
 * at Google Apps. In example, if your google account is foo.com, and you have a user that has an email john@foo.com, then you
 * must set the simplesaml.nameidattribute to be the name of an attribute that for this user has the value of 'john'.
 */
$metadata['google.com'] = array(
	'AssertionConsumerService' => 'https://www.google.com/a/g.feide.no/acs',
	'NameIDFormat' => 'urn:oasis:names:tc:SAML:1.1:nameid-format:emailAddress',
	'simplesaml.nameidattribute' => 'uid',
	'simplesaml.attributes' => FALSE,
);

$metadata['salesforce'] = array (
    'SingleLogoutService' =>
        array (
            0 =>
                array (
                    'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
                    'Location' => 'http://kaplan.gerryghall.co.uk/auth/saml/simplesmalphp/www/module.php/saml/sp/saml2-logout.php/default-sp',
                ),
        ),
    'AssertionConsumerService' =>
        array (
            0 =>
                array (
                    'index' => 0,
                    'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST',
                    'Location' => 'http://kaplan.gerryghall.co.uk/auth/saml/simplesmalphp/www/module.php/saml/sp/saml2-acs.php/default-sp',
                ),
            1 =>
                array (
                    'index' => 1,
                    'Binding' => 'urn:oasis:names:tc:SAML:1.0:profiles:browser-post',
                    'Location' => 'http://kaplan.gerryghall.co.uk/auth/saml/simplesmalphp/www/module.php/saml/sp/saml1-acs.php/default-sp',
                ),
            2 =>
                array (
                    'index' => 2,
                    'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Artifact',
                    'Location' => 'http://kaplan.gerryghall.co.uk/auth/saml/simplesmalphp/www/module.php/saml/sp/saml2-acs.php/default-sp',
                ),
            3 =>
                array (
                    'index' => 3,
                    'Binding' => 'urn:oasis:names:tc:SAML:1.0:profiles:artifact-01',
                    'Location' => 'http://kaplan.gerryghall.co.uk/auth/saml/simplesmalphp/www/module.php/saml/sp/saml1-acs.php/default-sp/artifact',
                ),
        ),
    'certData' => 'MIIErDCCA5SgAwIBAgIOAUdcdAO0AAAAABNWV9QwDQYJKoZIhvcNAQEFBQAwgZAxKDAmBgNVBAMMH1NlbGZTaWduZWRDZXJ0XzIySnVsMjAxNF8wNTAzMzAxGDAWBgNVBAsMDzAwREwwMDAwMDA1cWNsQTEXMBUGA1UECgwOU2FsZXNmb3JjZS5jb20xFjAUBgNVBAcMDVNhbiBGcmFuY2lzY28xCzAJBgNVBAgMAkNBMQwwCgYDVQQGEwNVU0EwHhcNMTQwNzIyMDUwMzMyWhcNMTYwNzIxMDUwMzMyWjCBkDEoMCYGA1UEAwwfU2VsZlNpZ25lZENlcnRfMjJKdWwyMDE0XzA1MDMzMDEYMBYGA1UECwwPMDBETDAwMDAwMDVxY2xBMRcwFQYDVQQKDA5TYWxlc2ZvcmNlLmNvbTEWMBQGA1UEBwwNU2FuIEZyYW5jaXNjbzELMAkGA1UECAwCQ0ExDDAKBgNVBAYTA1VTQTCCASIwDQYJKoZIhvcNAQEBBQADggEPADCCAQoCggEBALI76BJ5nT8NQs7tQUflWyb9ARaIuEYHs5sTNNKsO3NNI3XWxwp6jL6g2ADJo5nNw6pQdk4NE/x1gZZrf00gGBhApN/EmrtauN/LrF88/8KxMnSY1TVWdyj4nBBbuRPmRTa4rGWy2NZrgZpszpBOlUqAMX2+x2h+aC9Ie+cSLI+3pXY5qr6Fw+7ADK4ndJ8rJGIfgS/J/aYTL/TU4veOIRAvUqTcDzmj/yxqkwGfthM5NpzgOFrsXEntDTvOsjWF1VMOYedRoQG9h46h9svlZyENHCeB02/tRo1YBqAmqOQf/XH+bGGzDwNNIMwuAxbjCoWvIhRi0zMkWpL1CyhblPECAwEAAaOCAQAwgf0wHQYDVR0OBBYEFJjcm+t+YhNBXcJmc3wAkaB97qjcMIHKBgNVHSMEgcIwgb+AFJjcm+t+YhNBXcJmc3wAkaB97qjcoYGWpIGTMIGQMSgwJgYDVQQDDB9TZWxmU2lnbmVkQ2VydF8yMkp1bDIwMTRfMDUwMzMwMRgwFgYDVQQLDA8wMERMMDAwMDAwNXFjbEExFzAVBgNVBAoMDlNhbGVzZm9yY2UuY29tMRYwFAYDVQQHDA1TYW4gRnJhbmNpc2NvMQswCQYDVQQIDAJDQTEMMAoGA1UEBhMDVVNBgg4BR1x0A9YAAAAAE1ZX1DAPBgNVHRMBAf8EBTADAQH/MA0GCSqGSIb3DQEBBQUAA4IBAQA7Ma+xTR7+4JwL80I45BNzTpelGrqkTjzk8+hPSbFtJDJhUqsV5CDLxPMd736BhSqDsi8MgOHygX3fRi1B/1FA8F19O9M740uoCyIlQ7sCBBf1QeBlhfNVJrHfrqNRXSL/FhX3BFNBkGjyo5fkJVhuH5xvgdX4U+hxQOkkmbpbiLHmHH0hZKlgXkvvPtYaTYzI+mcJoKfAJEgLY3LEey9C3mYLtuph1GUYMn/CnpypjZCOkgoROFoYEK5rTAC/DfSv6SduTp2gcTPMNJc+zhOq/bv4luSJcza4Us6GfO0HBzALnSssqiBwvRY6PvnTPjpD1CF+6tHmWizHNw0q2I/G',
);