<?php
    session_start();
    if(!isset($_SESSION['social_registration'])) {
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
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,400i,700&display=swap" rel="stylesheet">
    <link rel="Stylesheet" type="text/css" href="css/fontello.css"/>
    <!--[if lt IE 9]>
        <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/r29/html5.min.js">
        </script>
    <![endif]-->
    <script src="https://www.google.com/recaptcha/api.js?render=<?php echo SITE_KEY; ?>"></script>
    <script type="text/javascript">
        if (window.location.hash && window.location.hash == '#_=_') {
            if (window.history && history.pushState) {
                window.history.pushState("", document.title, window.location.pathname);
            }
        }
    </script>
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
                    <div class="row col-10 col-md-8">
                        <div id="system-registration">
                            <div id="system-registration-connect">
                                <h2>Połącz konta</h2>
                                <p>Na adres <span><?php echo $_SESSION['mail_register']?></span> jest już założone konto <span><?php if(isset($_SESSION['type_account_exist'])){echo $_SESSION['type_account_exist'];}?></span>. Czy chesz połączyć to konto z kontem <?php echo ucfirst($_SESSION['type_register'])?></p>
                                <div id="account-data">
                                    <div id="account-data-existing">
                                        <div id="account-data-existing-name">
                                            <?php echo $_SESSION['name_account_exist']?>
                                        </div>
                                        <div id="account-data-existing-email">
                                            <?php echo $_SESSION['mail_account_exist']?>
                                        </div>
                                    </div>
                                    <div id="plus-account">
                                        <svg height="42px" width="42px" viewBox="0 0 512 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><path fill="#767676" d="M384,265H264v119h-17V265H128v-17h119V128h17v120h120V265z"/></g></svg>
                                    </div>
                                    <div id="account-data-created">
                                        <div id="account-photo-min">
                                            <?php 
                                                if($_SESSION['picture_register']!=""){echo '<img src="'.$_SESSION['picture_register'].'" alt="defult-photo"/>';}
                                                else {echo '<img src="img/defult-account.jpg" alt="defult-photo"/>';};
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <p id="account-description-info">Nie będziemy publikować niczego w Twoim imieniu.
                                    Poprosimy Cię o udostępnienie Twojego profilu
                                    publicznego oraz adresu e-mail.</p>
                                <div id="account-data-choose-section">
                                    <div id="account-data-choose-resigns">
                                        <a href="account-register.php" id="forwarding">ANULUJ</a>
                                    </div>
                                    <div id="account-data-choose-accept">
                                        <a class="accept-connect" href="account-linking.php">
                                            <button class="btn btn-primary accept-connect">
                                                <p>POŁĄCZ KONTA</p>
                                            </button>
                                        </a>
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
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="visual-effects.js"></script>
</body>
</html>