<?php 
    session_start();

    //Logout Google Account
    if(isset($_SESSION['g_access_token'])) {
        require_once "config.php";
        unset($_SESSION['g_access_token']);
        $gClient->revokeToken();
    }
    
    session_destroy();
    header('Location: index.php');
    exit();
?>