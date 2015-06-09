<?php
require __DIR__ . '/paypal_init.php';

use PayPal\Api\OpenIdSession;

$baseUrl = 'http://localhost/2.php';

//Get Authorization URL returns the redirect URL that could be used to get user's consent
$redirectUrl = OpenIdSession::getAuthorizationUrl(
$baseUrl,
array('profile', 'address', 'email', 'phone','https://uri.paypal.com/services/paypalattributes'),
null,
null,
null,
$apiContext
);

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
header("Location: ".$redirectUrl);
exit;