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
    <link rel="Stylesheet" type="text/css" href="css/fontello.css"/>
    <!--[if lt IE 9]>
        <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/r29/html5.min.js">
        </script>
    <![endif]-->
</head>
<body>
    <div id="page-wrapper">
        <div id="page-cnt-wrapper">
            <main>
                <div id="account-wrapper" class="container">
                    <div class="row col-12 col-xl-10">
                        <div id="system-account-container" class="col-12">
                            <div id="system-account-navbar">
                                <div class="system-account-options"><a href="panel.php"><i class="icon-home"></i><span>Strona główna</span></a></div>
                                <div class="system-account-options"><a href="panel-settings.php"><i class="icon-cog"></i><span>Opcje</span></a></div>
                                <div class="system-account-options"><a href="logout.php"><i class="icon-logout"></i><span>Wyloguj mnie</span></a></div>
                            </div>
                            <div id="system-account-home" class="system-account-items col-12 col-md-10 col-lg-8">
                                <div class="system-account-wrapper col-12">
                                    <h5>DANE KONTA</h5>
                                    <div id="account-photo"><img src="img/defult-account.jpg" alt="defult-photo"/></div>
                                    <div id="account-info">
                                        <h4><?php echo $_SESSION['login_copy']?></h4>
                                        <p><span>Adres e-mail: </span><?php echo $_SESSION['mail_copy']?></p>
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
    ?>
</body>
</html>