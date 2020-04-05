<?php
    //Checking your google account in the DT
    session_start();
    require_once('connect.php');
    require_once("config.php");

    $conn = @new mysqli($host, $db_user, $db_password, $db_name);
    if (!$conn->connect_errno) {

        $mail = $_SESSION['g_mail_register'];
        $name = $_SESSION['g_name_register'];
        $surname = $_SESSION['g_surname_register'];
        $type = $_SESSION['g_type_register'];
        $s_name = $_SESSION['g_s_name_register'];
        $picture = $_SESSION['g_picture_register'];
        $g_alt_id = $_SESSION['g_alt_id_register'];
        $authorization = true;
    
        $sql = "SELECT * FROM `users` WHERE g_alt_id='$g_alt_id'";
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
                        $_SESSION['g_unique_login_register'] = $uniqueID;

                        if($resultMailCheck>0){
                            $tabuser = [];
                            while($rowuser = $resultMail->fetch_assoc()) {
                                array_push($tabuser,$rowuser["type"]);
                            }

                            if(array_search("user", $tabuser)!==false){
                                $resultData = $conn->query("SELECT * FROM `users` WHERE mail='$mail' AND type='user'");
                                $data = $resultData->fetch_assoc();
                                if(empty($data['name'])||empty($data['surname'])) {
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
                                if(empty($data['name'])||empty($data['surname'])) {
                                    $_SESSION['name_account_exist'] = $data['login'];
                                }
                                else {
                                    $_SESSION['name_account_exist'] = $data['name']." ".$data['surname'];
                                }
                                $_SESSION['mail_account_exist'] = $data['mail'];
                                $_SESSION['type_account_exist'] = $data['type'];
                            }

                            $conn->close();
                            $_SESSION['g_registration'] = true;
                            header('Location: connect_account.php');
                            exit();
                        }
                    
                }
                else {$authorization = false;}

            }

            if($authorization) {
                $sql3 = "SELECT * FROM `users` WHERE g_alt_id='$g_alt_id'";
                if($resultLogin = @$conn->query($sql3)){
                    $row = $resultLogin->fetch_assoc();
                    $_SESSION['id_copy'] = $row['id'];

                    if(isset($_SESSION['g_mail_register']))unset($_SESSION['g_mail_register']);
                    if(isset($_SESSION['g_name_register']))unset($_SESSION['g_name_register']);
                    if(isset($_SESSION['g_surname_register']))unset($_SESSION['g_surname_register']);
                    if(isset($_SESSION['g_type_register']))unset($_SESSION['g_type_register']);
                    if(isset($_SESSION['g_s_name_register']))unset($_SESSION['g_s_name_register']);
                    if(isset($_SESSION['g_picture_register']))unset($_SESSION['g_picture_register']);
                    if(isset($_SESSION['g_alt_id_register']))unset($_SESSION['g_alt_id_register']);

                    $_SESSION['online'] = true;

                    $conn->close();
                    header('Location: panel.php');
                    exit();
                }
            }
        }
    }

    if(isset($_SESSION['g_mail_register']))unset($_SESSION['g_mail_register']);
    if(isset($_SESSION['g_name_register']))unset($_SESSION['g_name_register']);
    if(isset($_SESSION['g_surname_register']))unset($_SESSION['g_surname_register']);
    if(isset($_SESSION['g_type_register']))unset($_SESSION['g_type_register']);
    if(isset($_SESSION['g_s_name_register']))unset($_SESSION['g_s_name_register']);
    if(isset($_SESSION['g_picture_register']))unset($_SESSION['g_picture_register']);
    if(isset($_SESSION['g_alt_id_register']))unset($_SESSION['g_alt_id_register']);

    $_SESSION['l_error'] = 'Error: Błąd zapytania do bazy!';
    unset($_SESSION['g_access_token']);
    $gClient->revokeToken();
    header('Location: index.php');
    exit();

?>