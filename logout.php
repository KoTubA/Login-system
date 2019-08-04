<?php 
    session_start();
    unset($_SESSION['online']);
    unset($_SESSION['id_copy']);
    unset($_SESSION['login_copy']);
    unset($_SESSION['mail_copy']);
    header('Location: index.php');
?>