<?php
/**
 * SAML 2.0 remote IdP metadata for simpleSAMLphp.
 *
 * Remember to remove the IdPs you don't use from this file.
 *
 * See: https://rnd.feide.no/content/idp-remote-metadata-reference
 */

$metadata['https://kaplan--sfdev02.cs8.my.salesforce.com'] = array (
    'entityid' => 'https://kaplan--sfdev02.cs8.my.salesforce.com',
    'contacts' =>
        array (
        ),
    'metadata-set' => 'saml20-idp-remote',
    'expire' => 1723808947,
    'SingleSignOnService' =>
        array (
            0 =>
                array (
                    'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST',
                    'Location' => 'https://sfdev02-kaplanaustralia.cs8.force.com/studentportal/idp/endpoint/HttpPost',
                ),
            1 =>
                array (
                    'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
                    'Location' => 'https://kaplan--sfdev02.cs8.my.salesforce.com/idp/endpoint/HttpRedirect',
                ),
        ),
    'SingleLogoutService' =>
        array (
        ),
    'ArtifactResolutionService' =>
        array (
        ),
    'keys' =>
        array (
            0 =>
                array (
                    'encryption' => false,
                    'signing' => true,
                    'type' => 'X509Certificate',
                    'X509Certificate' => 'MIIErDCCA5SgAwIBAgIOAUdcdAO0AAAAABNWV9QwDQYJKoZIhvcNAQEFBQAwgZAxKDAmBgNVBAMMH1NlbGZTaWduZWRDZXJ0XzIySnVsMjAxNF8wNTAzMzAxGDAWBgNVBAsMDzAwREwwMDAwMDA1cWNsQTEXMBUGA1UECgwOU2FsZXNmb3JjZS5jb20xFjAUBgNVBAcMDVNhbiBGcmFuY2lzY28xCzAJBgNVBAgMAkNBMQwwCgYDVQQGEwNVU0EwHhcNMTQwNzIyMDUwMzMyWhcNMTYwNzIxMDUwMzMyWjCBkDEoMCYGA1UEAwwfU2VsZlNpZ25lZENlcnRfMjJKdWwyMDE0XzA1MDMzMDEYMBYGA1UECwwPMDBETDAwMDAwMDVxY2xBMRcwFQYDVQQKDA5TYWxlc2ZvcmNlLmNvbTEWMBQGA1UEBwwNU2FuIEZyYW5jaXNjbzELMAkGA1UECAwCQ0ExDDAKBgNVBAYTA1VTQTCCASIwDQYJKoZIhvcNAQEBBQADggEPADCCAQoCggEBALI76BJ5nT8NQs7tQUflWyb9ARaIuEYHs5sTNNKsO3NNI3XWxwp6jL6g2ADJo5nNw6pQdk4NE/x1gZZrf00gGBhApN/EmrtauN/LrF88/8KxMnSY1TVWdyj4nBBbuRPmRTa4rGWy2NZrgZpszpBOlUqAMX2+x2h+aC9Ie+cSLI+3pXY5qr6Fw+7ADK4ndJ8rJGIfgS/J/aYTL/TU4veOIRAvUqTcDzmj/yxqkwGfthM5NpzgOFrsXEntDTvOsjWF1VMOYedRoQG9h46h9svlZyENHCeB02/tRo1YBqAmqOQf/XH+bGGzDwNNIMwuAxbjCoWvIhRi0zMkWpL1CyhblPECAwEAAaOCAQAwgf0wHQYDVR0OBBYEFJjcm+t+YhNBXcJmc3wAkaB97qjcMIHKBgNVHSMEgcIwgb+AFJjcm+t+YhNBXcJmc3wAkaB97qjcoYGWpIGTMIGQMSgwJgYDVQQDDB9TZWxmU2lnbmVkQ2VydF8yMkp1bDIwMTRfMDUwMzMwMRgwFgYDVQQLDA8wMERMMDAwMDAwNXFjbEExFzAVBgNVBAoMDlNhbGVzZm9yY2UuY29tMRYwFAYDVQQHDA1TYW4gRnJhbmNpc2NvMQswCQYDVQQIDAJDQTEMMAoGA1UEBhMDVVNBgg4BR1x0A9YAAAAAE1ZX1DAPBgNVHRMBAf8EBTADAQH/MA0GCSqGSIb3DQEBBQUAA4IBAQA7Ma+xTR7+4JwL80I45BNzTpelGrqkTjzk8+hPSbFtJDJhUqsV5CDLxPMd736BhSqDsi8MgOHygX3fRi1B/1FA8F19O9M740uoCyIlQ7sCBBf1QeBlhfNVJrHfrqNRXSL/FhX3BFNBkGjyo5fkJVhuH5xvgdX4U+hxQOkkmbpbiLHmHH0hZKlgXkvvPtYaTYzI+mcJoKfAJEgLY3LEey9C3mYLtuph1GUYMn/CnpypjZCOkgoROFoYEK5rTAC/DfSv6SduTp2gcTPMNJc+zhOq/bv4luSJcza4Us6GfO0HBzALnSssqiBwvRY6PvnTPjpD1CF+6tHmWizHNw0q2I/G',
                ),
        ),
);

