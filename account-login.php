<?php
    //Logging in social account
    session_start();
    if(!isset($_SESSION['social_registration'])) {
        header('Location: index.php');
        exit();
    }

    $alt_id = $_SESSION['alt_id_register'];
    $type = $_SESSION['type_register'];
    if(isset($_SESSION['social_registration']))unset($_SESSION['social_registration']);
    if(isset($_SESSION['alt_id_register']))unset($_SESSION['alt_id_register']);
    if(isset($_SESSION['type_register']))unset($_SESSION['type_register']);

    require_once('connect.php');

    $conn = @new mysqli($host, $db_user, $db_password, $db_name);
    if ($conn->connect_errno) {
        $_SESSION['l_error'] = "Error: ".$conn->connect_errno;
    }
    else {
        if($type==="google"){
            $column = "g_alt_id";
        }
        else if($type==="facebook"){
            $column = "f_alt_id";
        }

        $sql = "SELECT * FROM `users` WHERE $column='$alt_id'";
        if($resultLogin = @$conn->query($sql)){
            $row = $resultLogin->fetch_assoc();
            $_SESSION['id_copy'] = $row['id'];

            $_SESSION['online'] = true;

            $conn->close();
            header('Location: panel.php');
            exit();
        }
        else {
            $_SESSION['l_error'] = 'Error: Błąd zapytania do bazy!';
            $conn->close();
        }
    }

    if(isset($_SESSION['g_access_token']))unset($_SESSION['g_access_token']);
    if(isset($_SESSION['f_access_token']))unset($_SESSION['f_access_token']);
    header('Location: index.php');
    exit();

?>