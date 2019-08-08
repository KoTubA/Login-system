<?php 

    session_start();

    if(!isset($_SESSION['registration'])) {
        header('Location: index.php');
        exit();
    }
    
    if(isset($_SESSION['registration']))unset($_SESSION['registration']);
    header('Location: index.php');
    
?>