<?php
    session_start();
	require_once "config.php";

	if (isset($_SESSION['g_access_token']))
		$gClient->setAccessToken($_SESSION['g_access_token']);
	else if (isset($_GET['code'])) {
		$token = $gClient->fetchAccessTokenWithAuthCode($_GET['code']);
		$_SESSION['g_access_token'] = $token;
	} else {
		header('Location: index.php');
		exit();
	}

	$oAuth = new Google_Service_Oauth2($gClient);
	$userData = $oAuth->userinfo_v2_me->get();

    $_SESSION['mail_register'] = $userData['email'];
    $_SESSION['name_register'] = $userData['given_name'];
    $_SESSION['surname_register'] = $userData['family_name'];
    $_SESSION['type_register'] = "google";
    $_SESSION['s_name_register'] = "name";
    $_SESSION['picture_register'] = $userData['picture'];
    $_SESSION['alt_id_register'] = $userData['id'];

    header('Location: account-check.php');
	exit();
?>