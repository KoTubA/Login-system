<?php
    //Checking your google account in the DT
    session_start();
    require_once('connect.php');
    require_once("config.php");

    $conn = @new mysqli($host, $db_user, $db_password, $db_name);
    if (!$conn->connect_errno) {

        $login = $_SESSION['login'];
        $mail = $_SESSION['mail'];
        $name = $_SESSION['name'];
        $surname = $_SESSION['surname'];
        $type = $_SESSION['type'];
        $s_name = $_SESSION['s_name'];
        $picture = $_SESSION['picture'];
        $g_alt_id = $_SESSION['g_alt_id'];
        $authorization = true;

        $sql = "SELECT * FROM `users` WHERE g_alt_id='$g_alt_id'";
        if($resultAccount = @$conn->query($sql)) {
            $resultAccountCheck = $resultAccount->num_rows;

            if($resultAccountCheck==0){
                $sql1 = "SELECT * FROM `users` WHERE mail='$mail'";
                if($resultMail = @$conn->query($sql1)) {
                    $resultMailCheck = $resultMail->num_rows;
                        $sql2 = "INSERT INTO `users` (`login`, `mail`, `name`, `surname`, `type`, `s_name`, `picture`, `g_alt_id`) VALUES ('$login', '$mail', '$name', '$surname', '$type', '$s_name', '$picture', '$g_alt_id')";

                        if(!$resultData = $conn->query($sql2)) {$authorization = false;}
                        if($resultMailCheck>0){
                            
                            if(isset($_SESSION['login']))unset($_SESSION['login']);
                            if(isset($_SESSION['name']))unset($_SESSION['name']);
                            if(isset($_SESSION['surname']))unset($_SESSION['surname']);
                            if(isset($_SESSION['s_name']))unset($_SESSION['s_name']);

                            $conn->close();
                            header('Location: connect_account.php');
                            $_SESSION['registration'] = true;
                            exit();
                        }
                    
                }
                else {$authorization = false;}

            }

            if($authorization) {
                $sql3 = "SELECT * FROM `users` WHERE g_alt_id='$g_alt_id'";
                if($resultLogin = @$conn->query($sql3)){
                    $row = $resultLogin->fetch_assoc();
                    $_SESSION['id_copy'] = $row['id'];

                    if(isset($_SESSION['login']))unset($_SESSION['login']);
                    if(isset($_SESSION['mail']))unset($_SESSION['mail']);
                    if(isset($_SESSION['name']))unset($_SESSION['name']);
                    if(isset($_SESSION['surname']))unset($_SESSION['surname']);
                    if(isset($_SESSION['type']))unset($_SESSION['type']);
                    if(isset($_SESSION['s_name']))unset($_SESSION['s_name']);
                    if(isset($_SESSION['picture']))unset($_SESSION['picture']);
                    if(isset($_SESSION['g_alt_id']))unset($_SESSION['g_alt_id']);

                    $_SESSION['online'] = true;

                    $conn->close();
                    header('Location: panel.php');
                    exit();
                }
            }
        }
    }

    if(isset($_SESSION['login']))unset($_SESSION['login']);
    if(isset($_SESSION['mail']))unset($_SESSION['mail']);
    if(isset($_SESSION['name']))unset($_SESSION['name']);
    if(isset($_SESSION['surname']))unset($_SESSION['surname']);
    if(isset($_SESSION['type']))unset($_SESSION['type']);
    if(isset($_SESSION['s_name']))unset($_SESSION['s_name']);
    if(isset($_SESSION['picture']))unset($_SESSION['picture']);
    if(isset($_SESSION['g_alt_id']))unset($_SESSION['g_alt_id']);

    $_SESSION['l_error'] = 'Error: Błąd zapytania do bazy!';
    unset($_SESSION['g_access_token']);
    $gClient->revokeToken();
    header('Location: index.php');
    exit();

?>