<?php

    session_start();

    if((!isset($_POST['form-register']))) {
        header('Location: index.php');
        exit();
    }

    require_once('connect.php');

    $conn = @new mysqli($host, $db_user, $db_password, $db_name);
    if ($conn->connect_errno) {
        $_SESSION['r_error'] = "Error: ".$conn->connect_errno;
    }
    else {
        $flag = true;

        $mail = mysqli_real_escape_string($conn,$_POST['r_mail']);
        $login = mysqli_real_escape_string($conn,$_POST['r_login']);
        $pass = mysqli_real_escape_string($conn,$_POST['r_pass']);
        $pass2 = mysqli_real_escape_string($conn,$_POST['r_pass2']);


        //Captcha 
        require_once('ReCAPTCHA.php');
        function getCaptcha($SecretKey){
            $Response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".SECRET_KEY."&response={$SecretKey}");
            $Return = json_decode($Response);
            return $Return;
        
        }

        $CAPTCHA = true;
        $Return = getCaptcha($_POST['g-recaptcha-response']);
        if(!$Return->success == true){
            $CAPTCHA = false;
        }

        if($CAPTCHA) {
            //E-mail
            if(!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                $flag = false;
                $_SESSION['er_mail'] = "Podaj właściwy adres e-mail";
            }
            else {
                $sql = "SELECT * FROM `users` WHERE mail='$mail'";
                if($resultMail = @$conn->query($sql)) {
                    $resultMailCheck = $resultMail->num_rows;
                    
                    if($resultMailCheck > 0) {
                        $flag = false;
                        $_SESSION['er_mail'] = "Adres e-mail już istnieje";
                    }

                    $resultMail->close();
                }
                else {
                    $_SESSION['r_error'] = 'Error: Błąd zapytania do bazy!';
                }
            }

            //Login
            if (strlen($login)<5) {
                $flag = false;
                $_SESSION['er_login'] = "Minimalna długość to 5 znaków";
            }
            else if (strlen($login)>32) {
                $flag = false;
                $_SESSION['er_login'] = "Maksymalna długość to 16 znaki";
            }
            else if(!preg_match("/^[a-zA-Z0-9:]+$/",$login)) {
                $flag = false;
                $_SESSION['er_login'] = "Podaj poprawny login";
            }
            else {
                $sql = "SELECT * FROM `users` WHERE login='$login'";
                if($result = @$conn->query($sql)) {
                    $resultCheck = $result->num_rows;
                    
                    if($resultCheck > 0) {
                        $flag = false;
                        $_SESSION['er_login'] = "Podany login już istnieje";
                    }

                    $result->close();
                }
                else {
                    $_SESSION['r_error'] = 'Error: Błąd zapytania do bazy!';
                }
            }

            //Password
            if (strlen($pass)<8) {
                $flag = false;
                $_SESSION['er_pass'] = "Minimalna długość hasła to 8 znaków";
                $_SESSION['er_pass2'] = "Minimalna długość hasła to 8 znaków";
            }

            if($pass!==$pass2) {
                $flag = false;
                $_SESSION['er_pass'] = "Hasła nie są identyczne";
                $_SESSION['er_pass2'] = "Hasła nie są identyczne";
            }
            else {
                $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
            }
            
        }

        if($flag && $CAPTCHA) {
            
            $sql = "INSERT INTO `users` (`mail`, `login`, `password`, `type`, `s_name`) VALUES ('$mail', '$login', '$pass_hash','user','login')";
            if($resultData = @$conn->query($sql)) {
                if(isset($_SESSION['er_mail']))unset($_SESSION['er_mail']);
                if(isset($_SESSION['er_login']))unset($_SESSION['er_login']);
                if(isset($_SESSION['er_pass']))unset($_SESSION['er_pass']);
                if(isset($_SESSION['er_pass2']))unset($_SESSION['er_pass2']);
                if(isset($_SESSION['r_error']))unset($_SESSION['r_error']);
                if(isset($_SESSION['fr_mail']))unset($_SESSION['fr_mail']);
                if(isset($_SESSION['fr_login']))unset($_SESSION['fr_login']);
                if(isset($_SESSION['space']))unset($_SESSION['space']);
                if(isset($_SESSION['e_register']))unset($_SESSION['e_register']);

                $conn->close();

                $_SESSION['registration'] = true;
                header('Location: registration.php');
                exit();
            }
            else {
                $_SESSION['r_error'] = 'Error: Błąd zapytania do bazy!';
            }
            
        }
        else {
            if(!$CAPTCHA) $_SESSION['e_register'] = "CAPTCHA sądzi, że jesteś botem!";
            else $_SESSION['e_register'] = "Upewnij się, czy wpisane dane są poprawne";
        }

        $_SESSION['fr_mail'] = $mail;
        $_SESSION['fr_login'] = $login;

        $conn->close();
    }
    
    $_SESSION['space'] = true;
    header('Location: index.php');
    exit();

?>