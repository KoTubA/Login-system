<?php
    session_start();
    
    if(!isset($_SESSION['registration'])) {
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
    <meta http-equiv="refresh" content="7.5; url=forwarding.php" />
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
    <script src="https://www.google.com/recaptcha/api.js?render=<?php echo SITE_KEY; ?>"></script>
</head>
<body>
    <div id="page-wrapper">
        <noscript>
            <div id="no-scirpt">
                <div id="no-scirpt-cnt">Nasza platforma wymaga JavaScript do niezbędnego funkcjowania! <span>
                Potrzebujesz pomocy, jak włączyć JavaScript? <a href="https://enable-javascript.com/" target="_blank">Przejdź tutaj.</a></span></div> 
            </div>
            <div id="overlay"></div>
        </noscript>
        <div id="page-cnt-wrapper">
            <main>
                <div id="system-login-wrapper" class="container">
                    <div class="row col-12 col-md-10">
                        <div id="system-registration">
                            <div id="system-registration-loader">
                                <div class="showbox">
                                    <div class="loader">
                                        <svg class="circular" viewBox="25 25 50 50">
                                        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div id="system-registration-wrapper" class="hide-cnt">
                                <div id="correct-registration-icon"><i class="icon-ok-circled"></i></div>
                                <div id="correct-description">Zarejestrowano! Przekierowanie nastąpi za 5s, lub kliknij w ten <a href="forwarding.php" id="forwarding">link</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="visual-effects.js"></script>
    <script>
        setTimeout(function(){
            $('#system-registration-loader').addClass('hide-cnt');
            $('#system-registration-wrapper').removeClass('hide-cnt');
            $('#correct-registration-icon').addClass('correct-registration');
        },2500);

    </script>
    <?php 
        if(isset($_SESSION['registration']))unset($_SESSION['registration']);
    ?>
</body>
</html>