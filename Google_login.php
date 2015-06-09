<?php
session_start();
require_once realpath(dirname(__FILE__) . '/Lib/Google/autoload.php');

$client_id = '1001729300634-f0s38a2351rikcqraome9jv7pt2r2ll9.apps.googleusercontent.com';
$client_secret = 'ucPfBQ6T1gU6AmIdFSre2kkB';
$redirect_uri = 'http://localhost/IntegratedLogin/Google_back.php';

$client = new Google_Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->addScope("email");
$client->addScope("profile");


$loginUrl = $client->createAuthUrl();

header("Location: ".$loginUrl);
exit;  