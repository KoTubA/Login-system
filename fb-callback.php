<?php
    session_start();
	require_once "config.php";

	try {
		$accessToken = $helper->getAccessToken();
	} catch (\Facebook\Exceptions\FacebookResponseException $e) {
		echo "Response Exception: " . $e->getMessage();
		exit();
	} catch (\Facebook\Exceptions\FacebookSDKException $e) {
		echo "SDK Exception: " . $e->getMessage();
		exit();
	}

	if (!$accessToken) {
		header('Location: index.php');
		exit();
	}

	$oAuth2Client = $FB->getOAuth2Client();
	if (!$accessToken->isLongLived())
		$accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);

	$response = $FB->get("me?fields=id,email,first_name,last_name,picture.type(large){url}", $accessToken);
	$userData = $response->getGraphNode()->asArray();

	$_SESSION['mail_register'] = $userData['email'];
    $_SESSION['name_register'] = $userData['first_name'];
    $_SESSION['surname_register'] = $userData['last_name'];
    $_SESSION['type_register'] = "facebook";
    $_SESSION['s_name_register'] = "name";
    $_SESSION['picture_register'] = $userData['picture']['url'];
    $_SESSION['alt_id_register'] = $userData['id'];
	$_SESSION['f_access_token'] = (string) $accessToken; //do narprawy

	header('Location: account-check.php');
	exit();

?>