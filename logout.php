<?php 
    session_start();
    unset($_SESSION['online']);
    header('Location: index.php');
?>