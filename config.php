<?php

    //Google API configuration
    require_once "GoogleAPI/vendor/autoload.php";

    define("GOOGLE_CLIENT_ID","my_client_id");
    define("GOOGLE_CLIENT_SECRET","my_client_secret");
    define("GOOGLE_CLIENT_URL","http://localhost/Login-system/g-callback.php");

    $gClient = new Google_Client();
    $gClient->setClientId(GOOGLE_CLIENT_ID);
    $gClient->setClientSecret(GOOGLE_CLIENT_SECRET);
    $gClient->setApplicationName("Login System");
    $gClient->setRedirectUri(GOOGLE_CLIENT_URL);
    $gClient->addScope("email");
    $gClient->addScope("profile");

    //Facebook API configuration
    require_once "Facebook/autoload.php";

	$FB = new \Facebook\Facebook([
		'app_id' => 'my_app_id',
		'app_secret' => 'my_app_secret',
        'default_graph_version' => 'v2.10'
	]);

	$helper = $FB->getRedirectLoginHelper();

?>