<?php
    session_start();
	require_once "config.php";

	if (isset($_SESSION['g_access_token']))
		$gClient->setAccessToken($_SESSION['g_access_token']);
	else if (isset($_GET['code'])) {
		$token = $gClient->fetchAccessTokenWithAuthCode($_GET['code']);
		$_SESSION['g_access_token'] = $token;  //Do poprawy
	} else {
		header('Location: index.php');
		exit();
	}

	$oAuth = new Google_Service_Oauth2($gClient);
	$userData = $oAuth->userinfo_v2_me->get();

    $_SESSION['login'] = $userData['given_name']." ".$userData['family_name'];
    $_SESSION['mail'] = $userData['email'];
    $_SESSION['name'] = $userData['given_name'];
    $_SESSION['surname'] = $userData['family_name'];
    $_SESSION['type'] = "google";
    $_SESSION['s_name'] = "name";
    $_SESSION['picture'] = $userData['picture'];
    $_SESSION['g_alt_id'] = $userData['id'];

    header('Location: g-check.php');

	exit();
?>