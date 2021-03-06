<?php

    session_start();

    if((!isset($_POST['p_login']))||(!isset($_POST['p_pass']))||(!isset($_POST['p_pass2']))) {
        header('Location: panel.php');
        exit();
    }
    require_once('connect.php');
    
    $conn = @new mysqli($host, $db_user, $db_password, $db_name);
    if ($conn->connect_errno) {
        $_SESSION['p_error'] = "Error: ".$conn->connect_errno;
    }
    else {

        $id = $_SESSION['id_copy'];
        $login = mysqli_real_escape_string($conn,$_POST['p_login']);
        $pass = mysqli_real_escape_string($conn,$_POST['p_pass']);
        $pass2 = mysqli_real_escape_string($conn,$_POST['p_pass2']);
        $pass2_hash = password_hash($pass2, PASSWORD_DEFAULT);

        $sql = "SELECT * FROM `users` WHERE login='$login' || mail='$login'";
        if($result = @$conn->query($sql)) {
            $resultCheck = $result->num_rows;
                if($resultCheck > 0) {
                    while($row = $result->fetch_assoc()){
                        if($_SESSION['id_copy']==$row['id']) {
                            if(isset($_SESSION['ep_logon']))unset($_SESSION['ep_logon']);
                            $flag = true;
                            if (strlen($pass)<8) {
                                $flag = false;
                                $_SESSION['ep_change'] = "Minimalna długość hasła to 8 znaków";
                            }
                            if (strlen($pass2)<8) {
                                $flag = false;
                                $_SESSION['ep_pass2'] = "Minimalna długość hasła to 8 znaków";
                            }
                            if($flag) {
                                if($pass==$pass2) {
                                    $sqlUpdate = "UPDATE `users` SET `password` = '$pass2_hash', `type` = 'user' WHERE login='$login' || mail='$login' AND id='$id'";
                                    if(@$conn->query($sqlUpdate)) {

                                        $result->close();
                                        $conn->close();

                                        $_SESSION['p_correct'] = 'Hasło zostało ustawione!';
                                        header('Location: panel.php');
                                        exit();
                                    }
                                    else {
                                        $_SESSION['p_error'] = 'Error: Błąd zapytania do bazy!';
                                    }
                                }
                                else {
                                    $_SESSION['ep_change'] = 'Hasła nie są identyczne';
                                    $_SESSION['ep_pass2'] = "Hasła nie są identyczne";
                                }
                            }
                            break;
                        }
                        else {
                            $_SESSION['ep_logon'] = 'Błędny login lub e-mail';
                        }
                    }
                }
                else {
                    $_SESSION['ep_logon'] = 'Błędny login lub e-mail';
                }

                $result->close();
        }
        else {
            $_SESSION['p_error'] = 'Error: Błąd zapytania do bazy!';
        }

        $conn->close();
    }

    header('Location: panel.php');
    exit();
?>