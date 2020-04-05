<?php
    //Logging in an unconnected account
    session_start();
    if(!isset($_SESSION['registration'])) {
        header('Location: index.php');
        exit();
    }
    if(isset($_SESSION['registration']))unset($_SESSION['registration']);

    require_once('connect.php');

    $conn = @new mysqli($host, $db_user, $db_password, $db_name);
    if ($conn->connect_errno) {
        $_SESSION['l_error'] = "Error: ".$conn->connect_errno;
    }
    else {
        if(isset($_SESSION['g_access_token'])) {
            $column = "g_alt_id";
        }
        else {
            $column = "f_alt_id";
        }
        
        $alt_id_register = $_SESSION['alt_id_register'];

        $sql = "SELECT * FROM `users` WHERE $column='$alt_id_register'";
        if($resultLogin = @$conn->query($sql)){
            $row = $resultLogin->fetch_assoc();
            $_SESSION['id_copy'] = $row['id'];

            if(isset($_SESSION['alt_id_register']))unset($_SESSION['alt_id_register']);
            $_SESSION['online'] = true;

            $conn->close();
            header('Location: panel.php');
            exit();
        }
        else {
            $_SESSION['l_error'] = 'Error: Błąd zapytania do bazy!';
        }
    }

    if(isset($_SESSION['alt_id_register']))unset($_SESSION['alt_id_register']);
    unset($_SESSION['g_access_token']);
    header('Location: index.php');
    exit();

?>