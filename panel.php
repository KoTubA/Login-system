<?php
    session_start();

    if(!isset($_SESSION['online'])) {
        header('Location: index.php');
        exit();
    }
    require_once('connect.php');
    
    $conn = @new mysqli($host, $db_user, $db_password, $db_name);
    if ($conn->connect_errno) {
        $_SESSION['panel_error'] = "Error: ".$conn->connect_errno;
    }
    else {
        $id_user = $_SESSION['id_copy'];

        $sql = "SELECT * FROM `users` WHERE id='$id_user'";
        if($result = @$conn->query($sql)) {
            $resultCheck = $result->num_rows;
                if($resultCheck > 0) {
                    $row = $result->fetch_assoc();

                    $_SESSION['online'] = true;
                    $_SESSION['type_copy'] = $row['type'];
                    $_SESSION['login_copy'] = $row['login'];
                    $_SESSION['mail_copy'] = $row['mail'];
                    $_SESSION['name_copy'] = $row['name'];
                    $_SESSION['surname_copy'] = $row['surname'];
                    $_SESSION['number_copy'] = $row['number'];
                    $_SESSION['s_name_copy'] = $row['s_name'];

                }
                else {
                    $_SESSION['panel_error'] = 'Error: Błąd bazy danych!';
                }

                $result->close();
        }
        else {
            $_SESSION['panel_error'] = 'Error: Błąd zapytania do bazy!';
        }

        $conn->close();
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="reply-to" content="szymon.kotarba988@gmail.com"/>
    <meta name="author" content="Szymon Kotarba"/>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <meta name="robots" content="index,follow"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>System logowania i rejestracji</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="Stylesheet" type="text/css" href="style.css"/>
    <link rel="Stylesheet" type="text/css" href="media.css"/>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,400i,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Muli:400,700&display=swap" rel="stylesheet">
    <link rel="Stylesheet" type="text/css" href="css/fontello.css"/>
    <!--[if lt IE 9]>
        <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/r29/html5.min.js">
        </script>
    <![endif]-->
</head>
<body>
    <div id="page-wrapper">
        <div class="overlay-pass"></div>
        <noscript>
            <div id="no-scirpt">
                <div id="no-scirpt-cnt">Nasza platforma wymaga JavaScript do niezbędnego funkcjowania! <span>
                Potrzebujesz pomocy, jak włączyć JavaScript? <a href="https://enable-javascript.com/" target="_blank">Przejdź tutaj.</a></span></div> 
            </div>
            <div id="overlay"></div>
        </noscript>
        <div id="page-cnt-wrapper">
            <main class="d-flex">
                <div id="account-wrapper" class="container-fluid p-0">
                    <div class="row col-12 col-xl-10 p-0 mw-100">
                        <div id="system-account-menu" class="col-2">
                            <div id="panel-user">User panel</div>
                            <div id="system-account-navbar">
                                <div class="system-account-options-user">
                                    <div id="account-photo-min" class="col-3">
                                        <img src="img/defult-account.jpg" alt="defult-photo">
                                    </div>
                                    <div id="account-info-user" class="col-9">
                                        <div id="account-info-login"><?php if($_SESSION['s_name_copy']=="login"){echo $_SESSION['login_copy'];}else {if(($_SESSION['name_copy']=='')&&($_SESSION['surname_copy']=='')){echo 'User '.$id_user;}else{echo $_SESSION['name_copy'].' '.$_SESSION['surname_copy'];}}?></div>
                                        <div id="account-info-group"><?php echo $_SESSION['type_copy']?></div>
                                    </div>
                                </div>
                                <div class="wrapp-input">
                                    <input type="search" class="form-control ds-input" id="search-input" placeholder="Szukaj..."autocomplete="off">
                                    <span class="icon-input-second"><i class="icon-search"></i></span>
                                </div>
                                <div class="system-account-options system-account-options-focus"><a href="panel.php"><i class="icon-home"></i><span>Strona główna</span></a></div>
                                <div class="system-account-options"><a href=""><i class="icon-cog"></i><span>Opcje</span></a></div>
                                <div class="system-account-options"><a href=""><i class="icon-help-circled"></i><span>Pomoc / wsparcie</span></a></div>
                                <div class="system-account-options"><a href="logout.php"><i class="icon-off"></i><span>Wyloguj mnie</span></a></div>
                            </div>
                        </div>
                        <div id="system-account-container" class="col-10">
                            <div id="system-account-info"><i class="icon-user"></i> Użytkownik: <?php if($_SESSION['s_name_copy']=="login"){echo $_SESSION['login_copy'];}else {if(($_SESSION['name_copy']=='')&&($_SESSION['surname_copy']=='')){echo 'User '.$id_user;}else{echo $_SESSION['name_copy'].' '.$_SESSION['surname_copy'];}}?></div>
                            <div id="system-account-home" class="system-account-items col-12">
                                <div class="system-account-wrapper col-12">
                                    <div class="invalid-feedback mb-4<?php if(isset($_SESSION['panel_error'])) echo ' invalid-visible';?>"><?php if(isset($_SESSION['panel_error'])) echo $_SESSION['panel_error'];?></div>
                                    <div id="account-photo"><img src="img/defult-account.jpg" alt="defult-photo"/></div>
                                    <div id="account-info">
                                        <h4 id="user-name"><?php if($_SESSION['s_name_copy']=="login"){echo $_SESSION['login_copy'];}else {if(($_SESSION['name_copy']=='')&&($_SESSION['surname_copy']=='')){echo 'User '.$id_user;}else{echo $_SESSION['name_copy'].' '.$_SESSION['surname_copy'];}}?></h4>
                                        <h3 id="user-group"><?php echo $_SESSION['type_copy']?></h3>
                                    </div>
                                    <div id="user-data">
                                        <h4 id="user-data-header">Dane konta</h4>
                                        <div id="cnt-user-data">
                                            <form  id="change-data" action="change-data.php" class="col-11" method="POST">
                                                <div class="wrapper-user-data row feedback">
                                                    <div class="name-user-data col-4"></div>
                                                    <div class="box-user-data col-8">
                                                        <div class="wrapp-input">
                                                            <div class="invalid-feedback<?php if(isset($_SESSION['datae_update'])||isset($_SESSION['data_error'])||isset($_SESSION['passe_update'])){echo ' invalid-visible';}else if (isset($_SESSION['data_correct'])){echo ' invalid-visible correct';}?>"><?php if(isset($_SESSION['datae_update'])){echo $_SESSION['datae_update'];}else if(isset($_SESSION['passe_update'])){echo $_SESSION['passe_update'];}else if(isset($_SESSION['data_error'])){echo $_SESSION['data_error'];}else if (isset($_SESSION['data_correct'])){echo $_SESSION['data_correct'];}?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="wrapper-user-data row">
                                                    <div class="name-user-data col-4">Login</div>
                                                    <div class="box-user-data col-8">
                                                        <div class="wrapp-input<?php if(isset($_SESSION['edata_login'])) echo ' alert-validate'?>">
                                                            <div class="error-message"><?php if(isset($_SESSION['edata_login'])) echo $_SESSION['edata_login']?></div>
                                                            <input class="form-control <?php if(isset($_SESSION['edata_login'])) echo ' is-invalid'?>" type="text" name="data_login" <?php if(isset($_SESSION['dataf_login'])){echo "value='".$_SESSION['dataf_login']."'";} else if(isset($_SESSION['login_copy'])){echo "value='".$_SESSION['login_copy']."'";}?>/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="wrapper-user-data row">
                                                    <div class="name-user-data col-4">E-mail</div>
                                                    <div class="box-user-data col-8">
                                                        <div class="wrapp-input<?php if(isset($_SESSION['edata_mail'])) echo ' alert-validate'?>">
                                                            <div class="error-message"><?php if(isset($_SESSION['edata_mail'])) echo $_SESSION['edata_mail']?></div>
                                                            <input class="form-control <?php if(isset($_SESSION['edata_mail'])) echo ' is-invalid'?>" type="text" name="data_mail" <?php if(isset($_SESSION['dataf_mail'])){echo "value='".$_SESSION['dataf_mail']."'";} else if(isset($_SESSION['mail_copy'])){echo "value='".$_SESSION['mail_copy']."'";}?>/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="wrapper-user-data row">
                                                    <div class="name-user-data col-4">Imie<p>(opcjonalnie)</p></div>
                                                    <div class="box-user-data col-8">
                                                        <input class="form-control" type="text" name="data_name" <?php if(isset($_SESSION['dataf_name'])){echo "value='".$_SESSION['dataf_name']."'";} else if(isset($_SESSION['name_copy'])){echo "value='".$_SESSION['name_copy']."'";}?>/>
                                                    </div>
                                                </div>
                                                <div class="wrapper-user-data row">
                                                    <div class="name-user-data col-4">Nazwisko<p>(opcjonalnie)</p></div>
                                                    <div class="box-user-data col-8">
                                                        <input class="form-control" type="text" name="data_surname" <?php if(isset($_SESSION['dataf_surname'])){echo "value='".$_SESSION['dataf_surname']."'";} else if(isset($_SESSION['surname_copy'])){echo "value='".$_SESSION['surname_copy']."'";}?>/>
                                                    </div>
                                                </div>
                                                <div class="wrapper-user-data row">
                                                    <div class="name-user-data col-4">Numer<p>(opcjonalnie)</p></div>
                                                    <div class="box-user-data col-8">
                                                        <div class="wrapp-input<?php if(isset($_SESSION['edata_number'])) echo ' alert-validate'?>">
                                                            <div class="error-message"><?php if(isset($_SESSION['edata_number'])) echo $_SESSION['edata_number']?></div>
                                                            <input class="form-control <?php if(isset($_SESSION['edata_number'])) echo ' is-invalid'?>" type="tel" name="data_number" <?php if(isset($_SESSION['dataf_number'])){echo "value='".$_SESSION['dataf_number']."'";} else if(isset($_SESSION['number_copy'])){echo "value='".$_SESSION['number_copy']."'";}?>/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="wrapper-user-data row">
                                                    <div class="name-user-data col-4">Nazwa użytkownika</div>
                                                    <div class="box-user-data col-8">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" class="custom-control-input" id="customControlValidation1" name="radio-stacked" value="login" required <?php if(isset($_SESSION['dataf_s_name'])){if($_SESSION['dataf_s_name']=="login") echo 'checked';} else if(isset($_SESSION['s_name_copy'])){if($_SESSION['s_name_copy']=="login") echo 'checked';}?>>
                                                            <label class="custom-control-label" for="customControlValidation1">Login</label>
                                                        </div>
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" class="custom-control-input" id="customControlValidation2" name="radio-stacked" value="n&sn" required <?php if(isset($_SESSION['dataf_s_name'])){if($_SESSION['dataf_s_name']=="n&sn") echo 'checked';} else if(isset($_SESSION['s_name_copy'])){if($_SESSION['s_name_copy']=="n&sn") echo 'checked';}?>>
                                                            <label class="custom-control-label" for="customControlValidation2">Imie i nazwisko</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="wrapper-user-data row justify-content-end">
                                                    <button type="button" class="btn btn-primary col-3 change-data-btn">Zmień dane</button>
                                                </div>
                                                <div id="passowrd-confirm" class="col-4">
                                                    <div id="passowrd-confirm-close"><i class="icon-cancel"></i></div>
                                                    <div id="paddowrd-confirm-cnt" class="col-11">
                                                        <h5>POTWIERDŹ ZMIANE</h5>
                                                        <div class="wrapp-input">
                                                            <input class="form-control <?php if(isset($_SESSION['passe_update'])) echo ' is-invalid'?>" type="password" name="data_pass" placeholder="Hasło"/>
                                                            <span class="icon-input"><i class="icon-lock"></i></span>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary change-data-btn-confirm">Zmień dane</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <h4 id="user-data-header">Zmień hasło</h4>
                                        <div id="cnt-user-data">
                                            <form id="change-account" action="change-pass-account.php" class="col-11" method="POST">
                                                <div class="wrapper-user-data row feedback">
                                                    <div class="name-user-data col-4"></div>
                                                    <div class="box-user-data col-8">
                                                        <div class="wrapp-input">
                                                            <div class="invalid-feedback<?php if(isset($_SESSION['ep_logon'])||isset($_SESSION['p_error'])||isset($_SESSION['ep_change'])||isset($_SESSION['ep_pass2'])){echo ' invalid-visible';}else if (isset($_SESSION['p_correct'])){echo ' invalid-visible correct';}?>"><?php if(isset($_SESSION['ep_logon'])){echo $_SESSION['ep_logon'];}else if(isset($_SESSION['p_error'])){echo $_SESSION['p_error'];}else if (isset($_SESSION['p_correct'])){echo $_SESSION['p_correct'];}else if(isset($_SESSION['ep_change'])){echo "Upewnij się, czy wpisane dane są poprawne";}else if (isset($_SESSION['ep_pass2'])){echo "Upewnij się, czy wpisane dane są poprawne";}?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="wrapper-user-data row">
                                                    <div class="name-user-data col-4">Login lub e-mail</div>
                                                    <div class="box-user-data col-8">
                                                        <div class="wrapp-input">
                                                            <input class="form-control <?php if(isset($_SESSION['ep_logon'])) echo ' is-invalid'?>" type="text" name="p_login" placeholder="Login lub e-mail" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="wrapper-user-data row">
                                                    <div class="name-user-data col-4">Hasło</div>
                                                    <div class="box-user-data col-8">
                                                        <div class="wrapp-input<?php if(isset($_SESSION['ep_change'])) echo ' alert-validate'?>">
                                                            <div class="error-message"><?php if(isset($_SESSION['ep_change'])) echo $_SESSION['ep_change']?></div>
                                                            <input class="form-control <?php if(isset($_SESSION['ep_logon'])||isset($_SESSION['ep_change'])) echo ' is-invalid'?>" type="password" name="p_pass" placeholder="Hasło"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                 <div class="wrapper-user-data row">
                                                    <div class="name-user-data col-4">Nowe hasło</div>
                                                    <div class="box-user-data col-8">
                                                        <div class="wrapp-input<?php if(isset($_SESSION['ep_pass2'])) echo ' alert-validate'?>">
                                                            <div class="error-message"><?php if(isset($_SESSION['ep_pass2'])) echo $_SESSION['ep_pass2']?></div>
                                                            <input class="form-control <?php if(isset($_SESSION['ep_logon'])||isset($_SESSION['ep_change'])||isset($_SESSION['ep_pass2'])) echo ' is-invalid'?>" type="password" name="p_pass2" placeholder="Nowe hasło"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="wrapper-user-data row justify-content-end">
                                                    <button type="submit" class="btn btn-primary col-3">Zmień hasło</button>
                                                </div>
                                            </form>
                                        </div>
                                        <h4 id="user-data-header">Usuń konto</h4>
                                        <div id="cnt-user-data">
                                            <form id="delete-account" action="delete-account.php" class="col-11" method="POST">
                                                <div class="wrapper-user-data row feedback">
                                                    <div class="name-user-data col-4"></div>
                                                    <div class="box-user-data col-8">
                                                        <div class="wrapp-input">
                                                            <div class="invalid-feedback<?php if(isset($_SESSION['de_delete'])||isset($_SESSION['d_error'])) echo ' invalid-visible'?>"><?php if(isset($_SESSION['de_delete'])){echo $_SESSION['de_delete'];}else if(isset($_SESSION['d_error'])){echo $_SESSION['d_error'];}?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="wrapper-user-data row">
                                                    <div class="name-user-data col-4">Login lub e-mail</div>
                                                    <div class="box-user-data col-8">
                                                        <div class="wrapp-input">
                                                            <input class="form-control <?php if(isset($_SESSION['de_delete'])) echo ' is-invalid'?>" type="text" name="d_login" placeholder="Login lub e-mail" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="wrapper-user-data row">
                                                    <div class="name-user-data col-4">Hasło</div>
                                                    <div class="box-user-data col-8">
                                                        <div class="wrapp-input">
                                                            <input class="form-control <?php if(isset($_SESSION['de_delete'])) echo ' is-invalid'?>" type="password" name="d_pass" placeholder="Hasło"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="wrapper-user-data row justify-content-end">
                                                    <button type="submit" class="btn btn-primary col-3">Usuń konto</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="visual-effects.js"></script>
    <script>
        $(document).ready(function() {
            $('.change-data-btn').on('click',function(e){
                e.preventDefault();
                $('#passowrd-confirm').addClass('passowrd-confirm-show');
                $('.overlay-pass').addClass('overlay-pass-show');
            });

            $('.overlay-pass, #passowrd-confirm-close').on('click', function(){
                $('#passowrd-confirm').removeClass('passowrd-confirm-show');
                $('.overlay-pass').removeClass('overlay-pass-show');
            });
        });
    </script>
    <?php 
        //Change data
        if(isset($_SESSION['data_error']))unset($_SESSION['data_error']);
        if(isset($_SESSION['data_correct']))unset($_SESSION['data_correct']);
        if(isset($_SESSION['datae_update']))unset($_SESSION['datae_update']);
        if(isset($_SESSION['passe_update']))unset($_SESSION['passe_update']);
        if(isset($_SESSION['edata_mail']))unset($_SESSION['edata_mail']);
        if(isset($_SESSION['edata_login']))unset($_SESSION['edata_login']);
        if(isset($_SESSION['edata_number']))unset($_SESSION['edata_number']);
        if(isset($_SESSION['dataf_mail']))unset($_SESSION['dataf_mail']);
        if(isset($_SESSION['dataf_number']))unset($_SESSION['dataf_number']);
        if(isset($_SESSION['dataf_login']))unset($_SESSION['dataf_login']);
        if(isset($_SESSION['dataf_name']))unset($_SESSION['dataf_name']);
        if(isset($_SESSION['dataf_surname']))unset($_SESSION['dataf_surname']);
        if(isset($_SESSION['dataf_s_name']))unset($_SESSION['dataf_s_name']);

        //Delete account
        if(isset($_SESSION['d_error']))unset($_SESSION['d_error']);
        if(isset($_SESSION['de_delete']))unset($_SESSION['de_delete']);

        //Change password account
        if(isset($_SESSION['p_error']))unset($_SESSION['p_error']);
        if(isset($_SESSION['p_correct']))unset($_SESSION['p_correct']);
        if(isset($_SESSION['ep_logon']))unset($_SESSION['ep_logon']);
        if(isset($_SESSION['ep_pass2']))unset($_SESSION['ep_pass2']);
        if(isset($_SESSION['ep_change']))unset($_SESSION['ep_change']);

        if(isset($_SESSION['panel_error']))unset($_SESSION['panel_error']);
    ?>
</body>
</html>