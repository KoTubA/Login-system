<?php 
    session_start();
    unset($_SESSION['online']);
    unset($_SESSION['id']);
    header('Location: index.php');
?>