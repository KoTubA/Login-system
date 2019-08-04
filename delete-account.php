<?php

    session_start();

    if((!isset($_POST['d_login']))||(!isset($_POST['d_pass']))) {
        header('Location: panel-settings.php');
        exit();
    }
    require_once('connect.php');
    
    $conn = @new mysqli($host, $db_user, $db_password, $db_name);
    if ($conn->connect_errno) {
        $_SESSION['d_error'] = "Error: ".$conn->connect_errno;
    }
    else {

        $login = mysqli_real_escape_string($conn,$_POST['d_login']);
        $pass = mysqli_real_escape_string($conn,$_POST['d_pass']);

        $sql = "SELECT * FROM `users` WHERE login='$login' || mail='$login'";
        if($result = @$conn->query($sql)) {
            $resultCheck = $result->num_rows;
                if($resultCheck > 0) {
                    $row = $result->fetch_assoc();
                    
                    if($_SESSION['id_copy']==$row['id']) {
                        if(password_verify($pass,$row['password'])){
                            $sqlDelete = "DELETE FROM `users` WHERE login='$login' || mail='$login'";
                            if(@$conn->query($sqlDelete)) {
                                $_SESSION['d_correct'] = 'Konto zostało usunięte!';
                                header('Location: logout.php');
                                if(isset($_SESSION['d_error']))unset($_SESSION['d_error']);
                                $result->close();
                                $conn->close();
                                exit();
                            }
                            else {
                                $_SESSION['d_error'] = 'Error: Błąd zapytania do bazy!';
                            }
                        }
                        else {
                            $_SESSION['de_logon'] = 'Błędny login lub hasło';
                        }
                    }
                    else {
                        $_SESSION['de_logon'] = 'Błędny login lub hasło';
                    }
                }
                else {
                    $_SESSION['de_logon'] = 'Błędny login lub hasło';
                }

                $result->close();
        }
        else {
            $_SESSION['d_error'] = 'Error: Błąd zapytania do bazy!';
        }

        $conn->close();
    }

    header('Location: panel-settings.php');
    exit();
?>