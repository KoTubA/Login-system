<?php
    //Logging in an unconnected account
    session_start();
    if(!isset($_SESSION['g_registration'])) {
        header('Location: index.php');
        exit();
    }
    if(isset($_SESSION['g_registration']))unset($_SESSION['g_registration']);

    require_once('connect.php');

    $conn = @new mysqli($host, $db_user, $db_password, $db_name);
    if ($conn->connect_errno) {
        $_SESSION['l_error'] = "Error: ".$conn->connect_errno;
    }
    else {
        
        $g_alt_id_register = $_SESSION['g_alt_id_register'];
        echo $g_alt_id_register;
        $sql = "SELECT * FROM `users` WHERE g_alt_id='$g_alt_id_register'";
        if($resultLogin = @$conn->query($sql)){
            $row = $resultLogin->fetch_assoc();
            $_SESSION['id_copy'] = $row['id'];

            if(isset($_SESSION['g_alt_id_register']))unset($_SESSION['g_alt_id_register']);
            $_SESSION['online'] = true;

            $conn->close();
            header('Location: panel.php');
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