<?php 
session_start(); 
define('FACEBOOK_SDK_V4_SRC_DIR', 'Lib/Facebook/src/Facebook/');
require __DIR__ . '/Lib/Facebook/autoload.php';

// Make sure to load the Facebook SDK for PHP via composer or manually

use Facebook\FacebookSession;
// add other classes you plan to use, e.g.:
// use Facebook\FacebookRequest;
// use Facebook\GraphUser;
// use Facebook\FacebookRequestException;
use Facebook\FacebookRedirectLoginHelper;

FacebookSession::setDefaultApplication('454864188008710', '44f08ba3d99cc49060588ec4f9ff6402');

$helper = new FacebookRedirectLoginHelper('http://localhost/IntegratedLogin/facebook_back.php');
$loginUrl = $helper->getLoginUrl();


header("Location: ".$loginUrl);
exit;  
?>