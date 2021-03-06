<?php

    session_start();

    if((!isset($_POST['d_login']))||(!isset($_POST['d_pass']))) {
        header('Location: panel.php');
        exit();
    }
    require_once('connect.php');
    
    $conn = @new mysqli($host, $db_user, $db_password, $db_name);
    if ($conn->connect_errno) {
        $_SESSION['d_error'] = "Error: ".$conn->connect_errno;
    }
    else {

        $id = $_SESSION['id_copy'];
        $login = mysqli_real_escape_string($conn,$_POST['d_login']);
        $pass = mysqli_real_escape_string($conn,$_POST['d_pass']);

        $sql = "SELECT * FROM `users` WHERE login='$login' || mail='$login'";
        if($result = @$conn->query($sql)) {
            $resultCheck = $result->num_rows;
                if($resultCheck > 0) {
                    while($row = $result->fetch_assoc()){
                        if($_SESSION['id_copy']==$row['id']) {
                            if(isset($_SESSION['de_delete']))unset($_SESSION['de_delete']);
                            if(password_verify($pass,$row['password'])){
                                $sqlDelete = "DELETE FROM `users` WHERE login='$login' || mail='$login' AND id='$id'";
                                if(@$conn->query($sqlDelete)) {

                                    $result->close();
                                    $conn->close();

                                    $_SESSION['d_correct'] = 'Konto zostało usunięte!';
                                    header('Location: logout.php');
                                    exit();
                                }
                                else {
                                    $_SESSION['d_error'] = 'Error: Błąd zapytania do bazy!';
                                }
                            }
                            else {
                                $_SESSION['de_delete'] = 'Błędny login lub hasło';
                            }
                            break;
                        }
                        else {
                            $_SESSION['de_delete'] = 'Błędny login lub hasło';
                        }
                    }
                }
                else {
                    $_SESSION['de_delete'] = 'Błędny login lub hasło';
                }

                $result->close();
        }
        else {
            $_SESSION['d_error'] = 'Error: Błąd zapytania do bazy!';
        }

        $conn->close();
    }

    header('Location: panel.php');
    exit();
?>