<?php
    //Linking account
    session_start();
    if(!isset($_SESSION['registration'])) {
        header('Location: index.php');
        exit();
    }

    require_once('connect.php');

    $data1 = $_SESSION['mail_register'];
    $data2 = $_SESSION['unique_login_register'];
    $data4 = $_SESSION['name_register'];
    $data5 = $_SESSION['surname_register'];
    $data7 = $_SESSION['type_register'];
    $data8 = $_SESSION['s_name_register'];
    $data9 = $_SESSION['picture_register'];

    //Check which social media is used to log in
    if(isset($_SESSION['g_access_token'])) {
        $data10 = $_SESSION['alt_id_register'];
    }
    else {
        $data11 = $_SESSION['alt_id_register'];
    }

    $id_account_exist = $_SESSION['id_account_exist'];

    if(isset($_SESSION['unique_login_register']))unset($_SESSION['unique_login_register']);
    if(isset($_SESSION['mail_register']))unset($_SESSION['mail_register']);
    if(isset($_SESSION['name_register']))unset($_SESSION['name_register']);
    if(isset($_SESSION['surname_register']))unset($_SESSION['surname_register']);
    if(isset($_SESSION['type_register']))unset($_SESSION['type_register']);
    if(isset($_SESSION['s_name_register']))unset($_SESSION['s_name_register']);
    if(isset($_SESSION['picture_register']))unset($_SESSION['picture_register']);
    if(isset($_SESSION['id_account_exist']))unset($_SESSION['id_account_exist']);
    if(isset($_SESSION['mail_account_exist']))unset($_SESSION['mail_account_exist']);
    if(isset($_SESSION['name_account_exist']))unset($_SESSION['name_account_exist']);
    if(isset($_SESSION['type_account_exist']))unset($_SESSION['type_account_exist']);

    $conn = @new mysqli($host, $db_user, $db_password, $db_name);
    if ($conn->connect_errno) {
        $_SESSION['l_error'] = "Error: ".$conn->connect_errno;
    }
    else {
        $sql = "SELECT * FROM `users` WHERE id='$id_account_exist'";
        if($resultAccount = @$conn->query($sql)) {
            $row = $resultAccount->fetch_assoc();

            //Security in case if the user has only a name
            if(!empty($row['name'])&&empty($row['surname'])) unset($data5);

            $i = 0;
            foreach($row as $item) {
                if(empty($item)&&isset(${'data'.$i})) {
                    ${'update_data_'.$i} = ${'data'.$i};
                }
                else {
                    ${'update_data_'.$i} = $item;
                }
                $i++;
            }

            $sql = "UPDATE `users` SET id = '$update_data_0', mail = '$update_data_1', login = '$update_data_2', password = '$update_data_3', name = '$update_data_4', surname = '$update_data_5', number = '$update_data_6', type = '$update_data_7', s_name = '$update_data_8', picture = '$update_data_9', g_alt_id = '$update_data_10', f_alt_id = '$update_data_11' WHERE id='$id_account_exist'";
            if($resultAccount = $conn->query($sql)) {
                header('Location: account-login.php');
                exit();
            }
            else {
                $_SESSION['l_error'] = 'Error: Błąd zapytania do bazy!';
            }
        }
        else {
            $_SESSION['l_error'] = 'Error: Błąd zapytania do bazy!';
        }
    }

    if(isset($_SESSION['alt_id_register']))unset($_SESSION['alt_id_register']);
    unset($_SESSION['g_access_token']);
    header('Location: index.php');
    exit();

?>