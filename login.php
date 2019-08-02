<?php

    if(isset($_POST['l_login'])&&isset($_POST['l_pass'])) {
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
                            echo "Zalogowano!";

                            if(!empty($_POST['remember-me'])) {
                                setcookie('name', $login, time() + (10 * 365 * 24 * 60 * 60));
                                setcookie('pass', $pass, time() + (10 * 365 * 24 * 60 * 60));
                                setcookie('checked', 'checked', time() + (10 * 365 * 24 * 60 * 60));
                            }
                        }
                        else {
                            echo 'Nieprawidłowy login lub hasło!';
                        }
                    }
                    else {
                        echo 'Nieprawidłowy login lub hasło!';
                    }
            }
            else {
                echo '<div id="error">Error: Błąd zapytania do bazy!</div>';
            }
        }
    }
?>