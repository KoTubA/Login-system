<?php

    session_start();

    if((!isset($_POST['p_login']))||(!isset($_POST['p_pass']))||(!isset($_POST['p_pass2']))) {
        header('Location: panel-settings.php');
        exit();
    }
    require_once('connect.php');
    
    $conn = @new mysqli($host, $db_user, $db_password, $db_name);
    if ($conn->connect_errno) {
        $_SESSION['p_error'] = "Error: ".$conn->connect_errno;
    }
    else {

        $login = mysqli_real_escape_string($conn,$_POST['p_login']);
        $pass = mysqli_real_escape_string($conn,$_POST['p_pass']);
        $pass2 = mysqli_real_escape_string($conn,$_POST['p_pass2']);
        $pass2_hash = password_hash($pass2, PASSWORD_DEFAULT);

        $sql = "SELECT * FROM `users` WHERE login='$login' || mail='$login'";
        if($result = @$conn->query($sql)) {
            $resultCheck = $result->num_rows;
                if($resultCheck > 0) {
                    $row = $result->fetch_assoc();
                    
                        if($_SESSION['id_copy']==$row['id']) {
                            if(password_verify($pass,$row['password'])) {
                                
                                $flag = true;
                                if (strlen($pass2)<5) {
                                    $flag = false;
                                    $_SESSION['ec_pass2'] = "Minimalna długość: 5";
                                }
                                if($flag) {
                                    if($pass!==$pass2) {
                                        $sqlUpdate = "UPDATE `users` SET `password` = '$pass2_hash' WHERE login='$login' || mail='$login'";
                                        if(@$conn->query($sqlUpdate)) {
                                            if(isset($_SESSION['p_error']))unset($_SESSION['p_error']);
                                            if(isset($_SESSION['p_correct']))unset($_SESSION['p_correct']);
                                            if(isset($_SESSION['pe_logon']))unset($_SESSION['pe_logon']);
                                            if(isset($_SESSION['ec_pass2']))unset($_SESSION['ec_pass2']);
                                            if(isset($_SESSION['ec_change']))unset($_SESSION['ec_change']);

                                            $result->close();
                                            $conn->close();

                                            $_SESSION['p_correct'] = 'Hasło zostało zmienione!';
                                            header('Location: panel-settings.php');
                                            exit();
                                        }
                                        else {
                                            $_SESSION['p_error'] = 'Error: Błąd zapytania do bazy!';
                                        }
                                    }
                                    else {
                                        $_SESSION['ec_change'] = 'Hasła są identyczne';
                                        $_SESSION['ec_pass2'] = "Hasła są identyczne";
                                    }
                                }
                            }
                            else {
                                $_SESSION['pe_logon'] = 'Błędny login lub hasło';
                            }
                        }
                        else {
                            $_SESSION['pe_logon'] = 'Błędny login lub hasło';
                        }
                }
                else {
                    $_SESSION['pe_logon'] = 'Błędny login lub hasło';
                }

                $result->close();
        }
        else {
            $_SESSION['p_error'] = 'Error: Błąd zapytania do bazy!';
        }

        $conn->close();
    }

    header('Location: panel-settings.php');
    exit();
?>