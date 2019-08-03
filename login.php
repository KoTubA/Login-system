<?php
    session_start();

    if((!isset($_POST['l_login']))||(!isset($_POST['l_pass']))) {
        header('Location: index.php');
        exit();
    }

    $login = htmlspecialchars($_POST['l_login']);
    $pass = $_POST['l_pass'];
    
    require_once('connect.php');
    
    $conn = @new mysqli($host, $db_user, $db_password, $db_name);
    if ($conn->connect_errno) {
        $_SESSION['error'] = "Error: ".$conn->connect_errno;
    }
    else {
        $sql = "SELECT * FROM `users` WHERE login='$login' || mail='$login'";
        if($result = $conn->query($sql)) {
            $resultCheck = $result->num_rows;
                if($resultCheck > 0) {
                    $row = $result->fetch_assoc();

                    if(password_verify($pass,$row['password'])){
                        $_SESSION['online'] = true;
                        header('Location: panel.php');

                        if(!empty($_POST['remember-me'])) {
                            setcookie('login', $login, time() + (10 * 365 * 24 * 60 * 60));
                            setcookie('pass', $pass, time() + (10 * 365 * 24 * 60 * 60));
                            setcookie('checked', 'checked', time() + (10 * 365 * 24 * 60 * 60));
                            unset($_SESSION['error']);
                        }
                    }
                    else {
                        $_SESSION['e_logon'] = true;
                    }
                }
                else {
                    $_SESSION['e_logon'] = true;
                }
                
                $_SESSION['fl_login'] = $login;
                $_SESSION['fl_pass'] = $pass;
                if(!empty($_POST['remember-me'])) $_SESSION['fl_remember-me'] = 'checked';

                unset($_SESSION['space']);
                $result->close();
        }
        else {
            $_SESSION['error'] = 'Error: Błąd zapytania do bazy!';
        }

        $conn->close();
    }

    header('Location: index.php');
    exit();
?>