<?php
    session_start();

    if((!isset($_POST['l_login']))||(!isset($_POST['l_pass']))) {
        header('Location: index.php');
        exit();
    }
    require_once('connect.php');
    
    $conn = @new mysqli($host, $db_user, $db_password, $db_name);
    if ($conn->connect_errno) {
        $_SESSION['l_error'] = "Error: ".$conn->connect_errno;
    }
    else {

        $login = mysqli_real_escape_string($conn,$_POST['l_login']);
        $pass = mysqli_real_escape_string($conn,$_POST['l_pass']);

        $sql = "SELECT * FROM `users` WHERE login='$login' || mail='$login'";
        if($result = @$conn->query($sql)) {
            $resultCheck = $result->num_rows;
                if($resultCheck > 0) {
                    $row = $result->fetch_assoc();

                    if(password_verify($pass,$row['password'])){
                        $_SESSION['online'] = true;
                        $_SESSION['id_copy'] = $row['id'];
                        $_SESSION['login_copy'] = $row['login'];
                        $_SESSION['mail_copy'] = $row['mail'];

                        if(!empty($_POST['remember-me'])) {
                            setcookie('login', $login, time() + (10 * 365 * 24 * 60 * 60));
                            setcookie('pass', $pass, time() + (10 * 365 * 24 * 60 * 60));
                            setcookie('checked', 'checked', time() + (10 * 365 * 24 * 60 * 60));
                        }

                        if(isset($_SESSION['e_logon']))unset($_SESSION['e_logon']);
                        if(isset($_SESSION['l_error']))unset($_SESSION['l_error']);
                        if(isset($_SESSION['fl_login']))unset($_SESSION['fl_login']);
                        if(isset($_SESSION['fl_pass']))unset($_SESSION['fl_pass']);
                        if(isset($_SESSION['fl_remember-me']))unset($_SESSION['fl_remember-me']);
                        
                        $result->close();
                        $conn->close();

                        header('Location: panel.php');
                        exit();
                    }
                    else {
                        $_SESSION['e_logon'] = "Błędny login lub hasło";
                    }
                }
                else {
                    $_SESSION['e_logon'] = "Błędny login lub hasło";
                }
                
                $_SESSION['fl_login'] = $login;
                $_SESSION['fl_pass'] = $pass;
                if(!empty($_POST['remember-me'])) $_SESSION['fl_remember-me'] = 'checked';

                $result->close();
        }
        else {
            $_SESSION['l_error'] = 'Error: Błąd zapytania do bazy!';
        }

        $conn->close();
    }

    if(isset($_SESSION['space']))unset($_SESSION['space']);
    header('Location: index.php');
    exit();
?>