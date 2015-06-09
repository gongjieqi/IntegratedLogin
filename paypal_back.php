<?php
require __DIR__ . '/paypal_init.php';

use PayPal\Api\OpenIdTokeninfo;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Api\OpenIdUserinfo;

session_start();


//code 是通过回调页面中获取,这里因写不到文件包里，所以用了上个请求的死code
$code = 'WgxQLcpFbh8_KvFHm4vyPdfQ1zoUK6Qst8GQn_Jn4VgioFpib1FFvb1p5hWlm7U3v_O0udf8aWpUepawDzwLnjVeSBFW8tfyTrkftqgAdOZld3UAVHelJP2sz1OxOoFJE8id1Xs3cl9kM3uTGSMruzsQiT3pPznDsUMSd1CgJbzBmfBkR7EKjPoYHpafl1t4NGlMbpRq-o2jP2H2';


//因为不能事实确定code  所以同理refreshToken也不能实时确定，所以只能注释一段 运行一段
/*try {
	$accessToken = OpenIdTokeninfo::createFromAuthorizationCode(array('code' => $code), null, null, $apiContext);
} catch (PayPalConnectionException $ex) {
	echo $ex;
	echo '<br/>';
	echo 'Obtained Access Toke error';
	exit(1);
}
//ResultPrinter::printResult("Obtained Access Token", "Access Token", $accessToken->getAccessToken(), $_GET['code'], $accessToken);
//echo $accessToken;
  */
$refreshToken = '37U50nT17RI-NI9yGGa13RWewsetvd_nCN0bYubIDLHyPNjcWQfeainJWkIzXZve6cfwNi86jIAtVlsRIP2vhAb3KWEiYVHBTZEaTVyCEFOy29XHC4AGEQBy42o';

try {

	$tokenInfo = new OpenIdTokeninfo();
	$tokenInfo = $tokenInfo->createFromRefreshToken(array('refresh_token' => $refreshToken), $apiContext);

	$params = array('access_token' => $tokenInfo->getAccessToken());
	$userInfo = OpenIdUserinfo::getUserinfo($params, $apiContext);

} catch (Exception $ex) {
	// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
	//ResultPrinter::printError("User Information", "User Info", null, $params, $ex);
	echo $ex;
	exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
//ResultPrinter::printResult("User Information", "User Info", $userInfo->getUserId(), $params, $userInfo);
print_r($userInfo);