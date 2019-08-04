<?php 

    session_start();
    unset($_SESSION['registration']);
    header('Location: index.php');
    
?>