<?php
    //Logging in an unconnected account
    session_start();
    require_once('connect.php');

    $conn = @new mysqli($host, $db_user, $db_password, $db_name);
    if (!$conn->connect_errno) {


        $g_alt_id = $_SESSION['g_alt_id'];

        $sql = "SELECT * FROM `users` WHERE g_alt_id='$g_alt_id'";
        if($resultLogin = @$conn->query($sql)){
            $row = $resultLogin->fetch_assoc();
            $_SESSION['id_copy'] = $row['id'];

            if(isset($_SESSION['mail']))unset($_SESSION['mail']);
            if(isset($_SESSION['type']))unset($_SESSION['type']);
            if(isset($_SESSION['picture']))unset($_SESSION['picture']);
            if(isset($_SESSION['g_alt_id']))unset($_SESSION['g_alt_id']);

            $_SESSION['online'] = true;

            $conn->close();
            header('Location: panel.php');
            exit();
        }
    }

    if(isset($_SESSION['mail']))unset($_SESSION['mail']);
    if(isset($_SESSION['type']))unset($_SESSION['type']);
    if(isset($_SESSION['picture']))unset($_SESSION['picture']);
    if(isset($_SESSION['g_alt_id']))unset($_SESSION['g_alt_id']);

    $_SESSION['l_error'] = 'Error: Błąd zapytania do bazy!';
    unset($_SESSION['g_access_token']);
    $gClient->revokeToken();
    header('Location: index.php');
    exit();

?>