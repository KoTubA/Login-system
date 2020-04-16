<?php 
    session_start();

    //Logout Google Account
    if(isset($_SESSION['g_access_token'])) {
        require_once "config.php";
        unset($_SESSION['g_access_token']);
        $gClient->revokeToken();
    }
    
    if(isset($_SESSION['d_correct'])) $delete = $_SESSION['d_correct'];
    session_destroy();
    //Proctect user which delete account
    session_start();
    $_SESSION['d_correct'] = $delete;
    header('Location: index.php');
    exit();
?>