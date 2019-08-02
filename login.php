<?php

    if((!isset($_POST['l_login']))||(!isset($_POST['l_pass']))) {
        header('Location: index.php');
        exit();
    }

    $login = htmlspecialchars($_POST['l_login']);
    $pass = $_POST['l_pass'];
    
    require_once('connect.php');

    $conn = @new mysqli($host, $db_user, $db_password, $db_name);
    if ($conn->connect_errno) {
        echo '<div id="error">Error: '.$conn->connect_errno.'</div>';
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
                            setcookie('name', $login, time() + (10 * 365 * 24 * 60 * 60));
                            setcookie('pass', $pass, time() + (10 * 365 * 24 * 60 * 60));
                            setcookie('checked', 'checked', time() + (10 * 365 * 24 * 60 * 60));
                            unset($_SESSION['error']);
                        }
                    }
                    else {
                        $_SESSION['error'] = true;
                        unset($_SESSION['space']);
                    }
                }
                else {
                    $_SESSION['error'] = true;
                    unset($_SESSION['space']);
                }

                $result->close();
        }
        else {
            echo '<div id="error">Error: Błąd zapytania do bazy!</div>';
        }

        $conn->close();
    }
?>