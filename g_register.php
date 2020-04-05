<?php
    //Registration in an unconnected account
    session_start();
    if(!isset($_SESSION['g_registration'])) {
        header('Location: index.php');
        exit();
    }

    require_once('connect.php');

    $login = $_SESSION['g_unique_login_register'];
    $mail = $_SESSION['g_mail_register'];
    $name = $_SESSION['g_name_register'];
    $surname = $_SESSION['g_surname_register'];
    $type = $_SESSION['g_type_register'];
    $s_name = $_SESSION['g_s_name_register'];
    $picture = $_SESSION['g_picture_register'];
    $g_alt_id = $_SESSION['g_alt_id_register'];

    if(isset($_SESSION['g_unique_login_register']))unset($_SESSION['g_unique_login_register']);
    if(isset($_SESSION['g_mail_register']))unset($_SESSION['g_mail_register']);
    if(isset($_SESSION['g_name_register']))unset($_SESSION['g_name_register']);
    if(isset($_SESSION['g_surname_register']))unset($_SESSION['g_surname_register']);
    if(isset($_SESSION['g_type_register']))unset($_SESSION['g_type_register']);
    if(isset($_SESSION['g_s_name_register']))unset($_SESSION['g_s_name_register']);
    if(isset($_SESSION['g_picture_register']))unset($_SESSION['g_picture_register']);
    if(isset($_SESSION['id_account_exist']))unset($_SESSION['id_account_exist']);
    if(isset($_SESSION['mail_account_exist']))unset($_SESSION['mail_account_exist']);
    if(isset($_SESSION['name_account_exist']))unset($_SESSION['name_account_exist']);
    if(isset($_SESSION['type_account_exist']))unset($_SESSION['type_account_exist']);
    
    $conn = @new mysqli($host, $db_user, $db_password, $db_name);
    if ($conn->connect_errno) {
        $_SESSION['l_error'] = "Error: ".$conn->connect_errno;
    }
    else {
        $sql = "INSERT INTO `users` (`login`, `mail`, `name`, `surname`, `type`, `s_name`, `picture`, `g_alt_id`) VALUES ('$login', '$mail', '$name', '$surname', '$type', '$s_name', '$picture', '$g_alt_id')";
        if($resultAccount = @$conn->query($sql)) {
            header('Location: g_login.php');
            exit();
        }
        else {
            $_SESSION['l_error'] = 'Error: Błąd zapytania do bazy!';
        }
    }

    if(isset($_SESSION['g_alt_id_register']))unset($_SESSION['g_alt_id_register']);
    unset($_SESSION['g_access_token']);
    header('Location: index.php');
    exit();

?>