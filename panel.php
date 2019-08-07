<?php
    session_start();

    if(!isset($_SESSION['online'])) {
        header('Location: index.php');
        exit();
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
                                        <div id="account-info-login"><?php echo $_SESSION['login_copy']?></div>
                                        <div id="account-info-group">User</div>
                                    </div>
                                </div>
                                <div class="system-account-options"><a href="panel.php"><i class="icon-home"></i><span>Strona główna</span></a></div>
                                <div class="system-account-options"><a href="panel-settings.php"><i class="icon-cog"></i><span>Opcje</span></a></div>
                                <div class="system-account-options"><a href="logout.php"><i class="icon-logout"></i><span>Wyloguj mnie</span></a></div>
                            </div>
                        </div>
                        <div id="system-account-container" class="col-10">
                            <div id="system-account-info"><i class="icon-user"></i> Użytkownik: <?php echo $_SESSION['login_copy']?></div>
                            <div id="system-account-home" class="system-account-items col-12">
                                <div class="system-account-wrapper col-12">
                                    <div id="account-photo"><img src="img/defult-account.jpg" alt="defult-photo"/></div>
                                    <div id="account-info">
                                        <h4 id="user-name"><?php echo $_SESSION['login_copy']?></h4>
                                        <h3 id="user-group"><?php echo $_SESSION['type_copy']?></h3>
                                    </div>
                                    <div id="user-data">
                                        <h4 id="user-data-header">Dane konta</h4>
                                        <div id="cnt-user-data">
                                            <form  id="change-data" class="col-11">
                                                <div class="wrapper-user-data row">
                                                    <div class="name-user-data col-4">Login</div>
                                                    <div class="box-user-data col-8">
                                                        <input class="form-control" type="text" name="login" value="<?php echo $_SESSION['login_copy']?>" disabled/>
                                                    </div>
                                                </div>
                                                <div class="wrapper-user-data row">
                                                    <div class="name-user-data col-4">E-mail</div>
                                                    <div class="box-user-data col-8">
                                                        <input class="form-control" type="text" name="mail" value="<?php echo $_SESSION['mail_copy']?>" disabled/>
                                                    </div>
                                                </div>
                                                <div class="wrapper-user-data row">
                                                    <div class="name-user-data col-4">Imie</div>
                                                    <div class="box-user-data col-8">
                                                        <input class="form-control" type="text" name="name" value="<?php ?>"/>
                                                    </div>
                                                </div>
                                                <div class="wrapper-user-data row">
                                                    <div class="name-user-data col-4">Nazwisko</div>
                                                    <div class="box-user-data col-8">
                                                        <input class="form-control" type="text" name="surname" value="<?php ?>"/>
                                                    </div>
                                                </div>
                                                <div class="wrapper-user-data row">
                                                    <div class="name-user-data col-4">Numer</div>
                                                    <div class="box-user-data col-8">
                                                        <input class="form-control" type="text" name="number" value="<?php ?>"/>
                                                    </div>
                                                </div>
                                                <div class="wrapper-user-data row">
                                                    <div class="name-user-data col-4">Nazwa użytkownika</div>
                                                    <div class="box-user-data col-8">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" class="custom-control-input" id="customControlValidation1" name="radio-stacked" required <?php if(isset($_SESSION['s_name_copy'])){if($_SESSION['s_name_copy']=="login") echo 'checked';}?>>
                                                            <label class="custom-control-label" for="customControlValidation1">Login</label>
                                                        </div>
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" class="custom-control-input" id="customControlValidation2" name="radio-stacked" required <?php if(isset($_SESSION['s_name_copy'])){if($_SESSION['s_name_copy']=="n&sn") echo 'checked';}?>>
                                                            <label class="custom-control-label" for="customControlValidation2">Imie i nazwisko</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="wrapper-user-data row justify-content-end">
                                                    <button type="submit" class="btn btn-primary col-3">Zmień dane</button>
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
                                                            <div class="invalid-feedback<?php if(isset($_SESSION['pe_logon'])||isset($_SESSION['p_error'])||isset($_SESSION['ec_change'])||isset($_SESSION['ec_pass2'])){echo ' invalid-visible';}else if (isset($_SESSION['p_correct'])){echo ' invalid-visible correct';}?>"><?php if(isset($_SESSION['pe_logon'])){echo $_SESSION['pe_logon'];}else if(isset($_SESSION['p_error'])){echo $_SESSION['p_error'];}else if (isset($_SESSION['p_correct'])){echo $_SESSION['p_correct'];}else if(isset($_SESSION['ec_change'])){echo "Upewnij się, czy wpisane dane są poprawne";}else if (isset($_SESSION['ec_pass2'])){echo "Upewnij się, czy wpisane dane są poprawne";}?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="wrapper-user-data row">
                                                    <div class="name-user-data col-4">Login lub e-mail</div>
                                                    <div class="box-user-data col-8">
                                                        <div class="wrapp-input">
                                                            <input class="form-control <?php if(isset($_SESSION['pe_logon'])) echo ' is-invalid'?>" type="text" name="p_login" placeholder="Login lub e-mail" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="wrapper-user-data row">
                                                    <div class="name-user-data col-4">Hasło</div>
                                                    <div class="box-user-data col-8">
                                                        <div class="wrapp-input<?php if(isset($_SESSION['ec_change'])) echo ' alert-validate'?>">
                                                            <div class="error-message"><?php if(isset($_SESSION['ec_change'])) echo $_SESSION['ec_change']?></div>
                                                            <input class="form-control <?php if(isset($_SESSION['pe_logon'])||isset($_SESSION['ec_change'])) echo ' is-invalid'?>" type="password" name="p_pass" placeholder="Hasło"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                 <div class="wrapper-user-data row">
                                                    <div class="name-user-data col-4">Nowe hasło</div>
                                                    <div class="box-user-data col-8">
                                                        <div class="wrapp-input<?php if(isset($_SESSION['ec_pass2'])) echo ' alert-validate'?>">
                                                            <div class="error-message"><?php if(isset($_SESSION['ec_pass2'])) echo $_SESSION['ec_pass2']?></div>
                                                            <input class="form-control <?php if(isset($_SESSION['pe_logon'])||isset($_SESSION['ec_change'])||isset($_SESSION['ec_pass2'])) echo ' is-invalid'?>" type="password" name="p_pass2" placeholder="Nowe hasło"/>
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
                                                            <div class="invalid-feedback<?php if(isset($_SESSION['de_logon'])||isset($_SESSION['d_error'])) echo ' invalid-visible'?>"><?php if(isset($_SESSION['de_logon'])){echo $_SESSION['de_logon'];}else if(isset($_SESSION['d_error'])){echo $_SESSION['d_error'];}?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="wrapper-user-data row">
                                                    <div class="name-user-data col-4">Login lub e-mail</div>
                                                    <div class="box-user-data col-8">
                                                        <div class="wrapp-input">
                                                            <input class="form-control <?php if(isset($_SESSION['de_logon'])) echo ' is-invalid'?>" type="text" name="d_login" placeholder="Login lub e-mail" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="wrapper-user-data row">
                                                    <div class="name-user-data col-4">Hasło</div>
                                                    <div class="box-user-data col-8">
                                                        <div class="wrapp-input">
                                                            <input class="form-control <?php if(isset($_SESSION['de_logon'])) echo ' is-invalid'?>" type="password" name="d_pass" placeholder="Hasło"/>
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
    <?php 
        if(isset($_SESSION['d_error']))unset($_SESSION['d_error']);
        if(isset($_SESSION['de_logon']))unset($_SESSION['de_logon']);

        if(isset($_SESSION['p_error']))unset($_SESSION['p_error']);
        if(isset($_SESSION['p_correct']))unset($_SESSION['p_correct']);
        if(isset($_SESSION['pe_logon']))unset($_SESSION['pe_logon']);
        if(isset($_SESSION['ec_pass2']))unset($_SESSION['ec_pass2']);
        if(isset($_SESSION['ec_change']))unset($_SESSION['ec_change']);
    ?>
</body>
</html>