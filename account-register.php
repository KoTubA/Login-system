<?php
    //Registration in an unconnected account
    session_start();
    if(!isset($_SESSION['social_registration'])) {
        header('Location: index.php');
        exit();
    }

    require_once('connect.php');

    $login = $_SESSION['unique_login_register'];
    $mail = $_SESSION['mail_register'];
    $name = $_SESSION['name_register'];
    $surname = $_SESSION['surname_register'];
    $type = $_SESSION['type_register'];
    $s_name = $_SESSION['s_name_register'];
    $picture = $_SESSION['picture_register'];
    $alt_id = $_SESSION['alt_id_register'];

    if(isset($_SESSION['unique_login_register']))unset($_SESSION['unique_login_register']);
    if(isset($_SESSION['mail_register']))unset($_SESSION['mail_register']);
    if(isset($_SESSION['name_register']))unset($_SESSION['name_register']);
    if(isset($_SESSION['surname_register']))unset($_SESSION['surname_register']);
    if(isset($_SESSION['s_name_register']))unset($_SESSION['s_name_register']);
    if(isset($_SESSION['picture_register']))unset($_SESSION['picture_register']);
    if(isset($_SESSION['id_account_exist']))unset($_SESSION['id_account_exist']);
    if(isset($_SESSION['mail_account_exist']))unset($_SESSION['mail_account_exist']);
    if(isset($_SESSION['name_account_exist']))unset($_SESSION['name_account_exist']);
    if(isset($_SESSION['type_account_exist']))unset($_SESSION['type_account_exist']);
    
    $conn = @new mysqli($host, $db_user, $db_password, $db_name);
    if ($conn->connect_errno) {
        $_SESSION['l_error'] = "Error: ".$conn->connect_errno;
    }
    else {
        //Check which social media is used to log in
        if($type==="google"){
            $column = "g_alt_id";
        }
        else if($type==="facebook"){
            $column = "f_alt_id";
        }

        $sql = "INSERT INTO `users` (`login`, `mail`, `name`, `surname`, `type`, `s_name`, `picture`, $column) VALUES ('$login', '$mail', '$name', '$surname', '$type', '$s_name', '$picture', '$alt_id')";
        if($resultAccount = @$conn->query($sql)) {
            $conn->close();
            header('Location: account-login.php');
            exit();
        }
        else {
            $_SESSION['l_error'] = 'Error: Błąd zapytania do bazy!';
            $conn->close();
        }
    }

    if(isset($_SESSION['alt_id_register']))unset($_SESSION['alt_id_register']);
    if(isset($_SESSION['g_access_token']))unset($_SESSION['g_access_token']);
    if(isset($_SESSION['f_access_token']))unset($_SESSION['f_access_token']);
    //header('Location: index.php');
    exit();

?>