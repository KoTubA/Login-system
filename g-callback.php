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

    $_SESSION['g_mail_register'] = $userData['email'];
    $_SESSION['g_name_register'] = $userData['given_name'];
    $_SESSION['g_surname_register'] = $userData['family_name'];
    $_SESSION['g_type_register'] = "google";
    $_SESSION['g_s_name_register'] = "name";
    $_SESSION['g_picture_register'] = $userData['picture'];
    $_SESSION['g_alt_id_register'] = $userData['id'];

    header('Location: g-check.php');

	exit();
?>