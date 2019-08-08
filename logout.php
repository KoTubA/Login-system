<?php 
    session_start();

    if(isset($_SESSION['online']))unset($_SESSION['online']);
    if(isset($_SESSION['id_copy']))unset($_SESSION['id_copy']);
    if(isset($_SESSION['type_copy']))unset($_SESSION['type_copy']);
    if(isset($_SESSION['login_copy']))unset($_SESSION['login_copy']);
    if(isset($_SESSION['mail_copy']))unset($_SESSION['mail_copy']);
    if(isset($_SESSION['name_copy']))unset($_SESSION['name_copy']);
    if(isset($_SESSION['surname_copy']))unset($_SESSION['surname_copy']);
    if(isset($_SESSION['number_copy']))unset($_SESSION['number_copy']);
    if(isset($_SESSION['s_name_copy']))unset($_SESSION['s_name_copy']);
    
    header('Location: index.php');
?>