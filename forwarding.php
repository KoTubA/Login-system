<?php 

    session_start();

    if(!isset($_SESSION['registration'])) {
        header('Location: index.php');
        exit();
    }
    
    unset($_SESSION['registration']);
    header('Location: index.php');
    
?>