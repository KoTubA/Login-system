<?php

    //Google configuration

    require_once "GoogleAPI/vendor/autoload.php";

    //Google API configuration
    define("GOOGLE_CLIENT_ID","");
    define("GOOGLE_CLIENT_SECRET","");
    define("GOOGLE_CLIENT_URL","http://localhost/Login-system/g-callback.php");

    $gClient = new Google_Client();
    $gClient->setClientId(GOOGLE_CLIENT_ID);
    $gClient->setClientSecret(GOOGLE_CLIENT_SECRET);
    $gClient->setApplicationName("Login System Project");
    $gClient->setRedirectUri(GOOGLE_CLIENT_URL);
    $gClient->addScope("email");
    $gClient->addScope("profile");

    //Facebook configuration
    require_once "Facebook/autoload.php";

	$FB = new \Facebook\Facebook([
		'app_id' => '',
		'app_secret' => '',
        'default_graph_version' => 'v2.6',
        "persistent_data_handler"=>"session"
	]);


	$helper = $FB->getRedirectLoginHelper();
    
    if (isset($_GET['state'])) {
        $helper->getPersistentDataHandler()->set('state', $_GET['state']);  //this solution bypasses a CSRF check
    }

?>