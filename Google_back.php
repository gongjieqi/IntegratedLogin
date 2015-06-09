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

$plus = new Google_Service_Plus($client);

if (isset($_GET['code'])) {
	$client->authenticate($_GET['code']);
	$token = $client->getAccessToken();
	$token = json_decode($client->getAccessToken());
	$ticket = $client->verifyIdToken($token->id_token);
	if ($ticket) {
		$data = $ticket->getAttributes();
		$user = $plus->people->get("me");
		echo 'id:'.$user->getId();
		echo '<br/>';
		echo '<br/>';
		print_r($user);
		echo '<br/>';
		echo '<br/>';
		print_r($user->getName());
		echo '<br/>';
		echo '<br/>';
		print_r($user->getCover());
		echo '<br/>';
		echo '<br/>';
		print_r($user->getImage());

		echo '<br/>';
		echo '<br/>';
		print_r($user->getEmails());
	}
	echo 'error';
}