<?php

    session_start();

    if((!isset($_POST['data_login']))||(!isset($_POST['data_pass']))) {
        header('Location: panel.php');
        exit();
    }
    require_once('connect.php');
    
    $conn = @new mysqli($host, $db_user, $db_password, $db_name);
    if ($conn->connect_errno) {
        $_SESSION['data_error'] = "Error: ".$conn->connect_errno;
    }
    else {

        $login = mysqli_real_escape_string($conn,$_POST['data_login']);
        $mail = mysqli_real_escape_string($conn,$_POST['data_mail']);
        $name = mysqli_real_escape_string($conn,$_POST['data_name']);
        $surname = mysqli_real_escape_string($conn,$_POST['data_surname']);
        $number = mysqli_real_escape_string($conn,$_POST['data_number']);
        $pass = mysqli_real_escape_string($conn,$_POST['data_pass']);
        $s_name = mysqli_real_escape_string($conn,$_POST['radio-stacked']);

        $id_user = $_SESSION['id_copy'];
        
        $sql = "SELECT * FROM `users` WHERE id='$id_user'"; 
        if($result = @$conn->query($sql)) {
            $resultCheck = $result->num_rows;
                if($resultCheck > 0) {
                    $row = $result->fetch_assoc();
                    
                    if($id_user==$row['id']) {

                        $data_login = $row['login'];
                        $data_mail = $row['mail'];
                        $flag = true;

                        //Login
                        if (strlen($login)<5) {
                            $flag = false;
                            $_SESSION['edata_login'] = "Minimalna długość: 5";
                        }
                        else if (strlen($login)>16) {
                            $flag = false;
                            $_SESSION['edata_login'] = "Maksymalna długość: 16";
                        }
                        else if(!preg_match("/^[a-zA-Z0-9]+$/",$login)) {
                            $flag = false;
                            $_SESSION['edata_login'] = "Podaj poprawny login";
                        }
                        else {
                            $sql = "SELECT * FROM `users` WHERE login='$login'";
                            if($result = @$conn->query($sql)) {
                                $resultCheck = $result->num_rows;
                                
                                if($resultCheck > 0) {
                                    if($login!=$data_login) {
                                        $flag = false;
                                        $_SESSION['edata_login'] = "Login już istnieje";
                                    }
                                }

                                $result->close();
                            }
                            else {
                                $_SESSION['data_error'] = 'Error: Błąd zapytania do bazy!';
                            }
                        }

                        //E-mail
                        if(!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                            $flag = false;
                            $_SESSION['edata_mail'] = "Podaj właściwy adres e-mail";
                        }
                        else {
                            $sql = "SELECT * FROM `users` WHERE mail='$mail'";
                            if($resultMail = @$conn->query($sql)) {
                                $resultMailCheck = $resultMail->num_rows;
                                
                                if($resultMailCheck > 0) {
                                    if($mail!=$data_mail) {
                                        $flag = false;
                                        $_SESSION['edata_mail'] = "Adres e-mail już istnieje";
                                    }
                                }

                                $resultMail->close();
                            }
                            else {
                                $_SESSION['data_error'] = 'Error: Błąd zapytania do bazy!';
                            }
                        }

                        //Number
                        if (strlen($number)!=9) {
                            if($number!="") {
                                $flag = false;
                                $_SESSION['edata_number'] = "Wymagana ilość znaków: 9";
                            }
                        }

                        if($flag) {
                            if(password_verify($pass,$row['password'])) {
                                $sqlUpdate = "UPDATE `users` SET `login` = '$login', `mail` = '$mail', `name` = '$name', `surname` = '$surname', `number` = '$number', `s_name` = '$s_name' WHERE id='$id_user'";;
                                if(@$conn->query($sqlUpdate)) {

                                    $result->close();
                                    $conn->close();

                                    $_SESSION['data_correct'] = 'Dane zostały zatkualizowane!';
                                    header('Location: panel.php');
                                    exit();
                                }
                                else {
                                    $_SESSION['data_error'] = 'Error: Błąd zapytania do bazy!';
                                }
                            }
                            else {
                                $_SESSION['passe_update'] = 'Niepoprawne hasło';
                            }
                        }
                        else {
                            $_SESSION['datae_update'] = "Upewnij się, czy wpisane dane są poprawne";
                        }
                    }
                    else {
                        $_SESSION['data_error'] = 'Error: Błąd bazy danych!';
                    }
                }
                else {
                    $_SESSION['data_error'] = 'Error: Błąd bazy danych!';
                }

                $result->close();
        }

        else {
            $_SESSION['data_error'] = 'Error: Błąd zapytania do bazy!';
        }


        $_SESSION['dataf_mail'] = $mail;
        $_SESSION['dataf_login'] = $login;
        $_SESSION['dataf_name'] = $name;
        $_SESSION['dataf_number'] = $number;
        $_SESSION['dataf_surname'] = $surname;
        $_SESSION['dataf_s_name'] = $s_name;

        $conn->close();
    }

    header('Location: panel.php');
    exit();
?>