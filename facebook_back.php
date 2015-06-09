<?php 
session_start(); 
define('FACEBOOK_SDK_V4_SRC_DIR', 'Lib/Facebook/src/Facebook/');
require __DIR__ . '/Lib/Facebook/autoload.php';
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;


FacebookSession::setDefaultApplication('454864188008710', '44f08ba3d99cc49060588ec4f9ff6402');
$helper = new FacebookRedirectLoginHelper('http://localhost/IntegratedLogin/facebook_back.php');
try {
  $session = $helper->getSessionFromRedirect();
} catch(FacebookRequestException $ex) {
  // When Facebook returns an error
  echo 'returns error';
} catch(\Exception $ex) {
  // When validation fails or other local issues
  echo 'validation fails';
}
if($session) {
  try {
    $user_profile = (new FacebookRequest(
      $session, 'GET', '/me'
    ))->execute()->getGraphObject(GraphUser::className());
    echo "Name: " . $user_profile->getName();
    echo '<br/>';
    echo "ID: ".$user_profile->getProperty("email");
    echo '<br/>';
    echo "ID: ".$user_profile->getProperty("id");
  } catch(FacebookRequestException $e) {
    echo "Exception occured, code: " . $e->getCode();
    echo " with message: " . $e->getMessage();
  }   
}