<?php

    session_start();

    if($_SESSION['type_copy']=="user"||$_SESSION['type_copy']=="admin") {
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
        $mail = $_SESSION['mail_copy'];

        $sql = "SELECT * FROM `users` WHERE mail='$mail' AND id='$id'";
        if($result = @$conn->query($sql)) {
            $resultCheck = $result->num_rows;
                if($resultCheck > 0) {
                    $row = $result->fetch_assoc();
                    
                    if($_SESSION['id_copy']==$row['id']) {
                        $sqlDelete = "DELETE FROM `users` WHERE mail='$mail' AND id='$id'";
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