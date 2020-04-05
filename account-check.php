<?php
    //Checking your google account in the DT
    session_start();
    require_once('connect.php');

    if(isset($_SESSION['f_access_token'])||isset($_SESSION['g_access_token'])){

        $conn = @new mysqli($host, $db_user, $db_password, $db_name);
        if (!$conn->connect_errno) {

            $mail = $_SESSION['mail_register'];
            $name = $_SESSION['name_register'];
            $surname = $_SESSION['surname_register'];
            $type = $_SESSION['type_register'];
            $s_name = $_SESSION['s_name_register'];
            $picture = $_SESSION['picture_register'];
            $alt_id = $_SESSION['alt_id_register'];
            $authorization = true;

            //Check which social media is used to log in
            if(isset($_SESSION['g_access_token'])) {
                $column = "g_alt_id";
            }
            else {
                $column = "f_alt_id";
            }

            $sql = "SELECT * FROM `users` WHERE $column='$alt_id'";
            if($resultAccount = @$conn->query($sql)) {
                $resultAccountCheck = $resultAccount->num_rows;

                if($resultAccountCheck==0){
                    $sql1 = "SELECT * FROM `users` WHERE mail='$mail'";
                    if($resultMail = @$conn->query($sql1)) {
                        $resultMailCheck = $resultMail->num_rows;
                            //Unique id login
                            do {
                                $uniqueID = "Client:".uniqid();
                                $resultUnique = $conn->query("SELECT `login` FROM `users` WHERE login='$uniqueID'");
                                $exists = $resultUnique->num_rows;
                            } while ($exists===1);
                            $_SESSION['unique_login_register'] = $uniqueID;

                            if($resultMailCheck>0){
                                $tabuser = [];
                                while($rowuser = $resultMail->fetch_assoc()) {
                                    array_push($tabuser,$rowuser["type"]);
                                }

                                if(array_search("user", $tabuser)!==false){
                                    $resultData = $conn->query("SELECT * FROM `users` WHERE mail='$mail' AND type='user'");
                                    $data = $resultData->fetch_assoc();
                                    if(empty($data['name'])&&empty($data['surname'])) {
                                        $_SESSION['name_account_exist'] = $data['login'];
                                    }
                                    else {
                                        $_SESSION['name_account_exist'] = $data['name']." ".$data['surname'];
                                    }
                                    $_SESSION['mail_account_exist'] = $data['mail'];
                                    $_SESSION['id_account_exist'] = $data['id'];
                                }
                                else if(array_search("facebook", $tabuser)!==false){
                                    $resultData = $conn->query("SELECT * FROM `users` WHERE mail='$mail' AND type='facebook'");
                                    $data = $resultData->fetch_assoc();
                                    if(empty($data['name'])&&empty($data['surname'])) {
                                        $_SESSION['name_account_exist'] = $data['login'];
                                    }
                                    else {
                                        $_SESSION['name_account_exist'] = $data['name']." ".$data['surname'];
                                    }
                                    $_SESSION['mail_account_exist'] = $data['mail'];
                                    $_SESSION['type_account_exist'] = $data['type'];
                                    $_SESSION['id_account_exist'] = $data['id'];
                                }
                                else if(array_search("google", $tabuser)!==false){
                                    $resultData = $conn->query("SELECT * FROM `users` WHERE mail='$mail' AND type='google'");
                                    $data = $resultData->fetch_assoc();
                                    if(empty($data['name'])&&empty($data['surname'])) {
                                        $_SESSION['name_account_exist'] = $data['login'];
                                    }
                                    else {
                                        $_SESSION['name_account_exist'] = $data['name']." ".$data['surname'];
                                    }
                                    $_SESSION['mail_account_exist'] = $data['mail'];
                                    $_SESSION['type_account_exist'] = $data['type'];
                                    $_SESSION['id_account_exist'] = $data['id'];
                                }

                                $conn->close();
                                $_SESSION['registration'] = true;
                                header('Location: connect-account.php');
                                exit();
                            }
                            else {
                                $conn->close();
                                $_SESSION['registration'] = true;
                                header('Location: account-register.php');
                                exit();
                            }
                        
                    }
                    else {$authorization = false;}

                }

                if($authorization) {
                    $sql3 = "SELECT * FROM `users` WHERE $column='$alt_id'";
                    if($resultLogin = @$conn->query($sql3)){
                        $row = $resultLogin->fetch_assoc();
                        $_SESSION['id_copy'] = $row['id'];

                        if(isset($_SESSION['mail_register']))unset($_SESSION['mail_register']);
                        if(isset($_SESSION['name_register']))unset($_SESSION['name_register']);
                        if(isset($_SESSION['surname_register']))unset($_SESSION['surname_register']);
                        if(isset($_SESSION['type_register']))unset($_SESSION['type_register']);
                        if(isset($_SESSION['s_name_register']))unset($_SESSION['s_name_register']);
                        if(isset($_SESSION['picture_register']))unset($_SESSION['picture_register']);
                        if(isset($_SESSION['alt_id_register']))unset($_SESSION['alt_id_register']);

                        $_SESSION['online'] = true;

                        $conn->close();
                        header('Location: panel.php');
                        exit();
                    }
                }
            }
        }
    }

    if(isset($_SESSION['mail_register']))unset($_SESSION['mail_register']);
    if(isset($_SESSION['name_register']))unset($_SESSION['name_register']);
    if(isset($_SESSION['surname_register']))unset($_SESSION['surname_register']);
    if(isset($_SESSION['type_register']))unset($_SESSION['type_register']);
    if(isset($_SESSION['s_name_register']))unset($_SESSION['s_name_register']);
    if(isset($_SESSION['picture_register']))unset($_SESSION['picture_register']);
    if(isset($_SESSION['alt_id_register']))unset($_SESSION['alt_id_register']);

    $_SESSION['l_error'] = 'Error: Błąd zapytania do bazy!';
    unset($_SESSION['g_access_token']);
    $gClient->revokeToken();
    header('Location: index.php');
    exit();

?>