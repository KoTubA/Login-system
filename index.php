<?php

    session_start();
    
    require_once('config.php');
    
    //Create a URL to obtain user authorization
	$gloginURL = $gClient->createAuthUrl();

    //Facebook create a URL to obtain user authorization
    $redirectURL = "http://localhost/Login-system/fb-callback.php";
	$permissions = ['email'];
	$floginURL = $helper->getLoginUrl($redirectURL, $permissions);
    
    //This is for check user has login into system by using Google/Facebook/Defult account
    if(isset($_SESSION['online'])||isset($_SESSION['g_access_token'])||isset($_SESSION['f_access_token'])) {
        header('Location: panel.php');
        exit();
    }

    require_once('ReCAPTCHA.php');
    
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
                    <div class="row col-12 col-xl-10">
                        <div id="system-login-container">
                            <div id="login-wrapper" class="col-12 col-sm-10 col-md-6<?php if(isset($_SESSION['space'])) echo ' hidden-el'?>">
                                <div id="login-form">
                                    <h5>ZALOGUJ SIĘ</h5>
                                    <form id="login-system" action="login.php" method="POST">
                                        <div class="invalid-feedback<?php if(isset($_SESSION['e_logon'])||isset($_SESSION['l_error'])){echo ' invalid-visible';} else if (isset($_SESSION['d_correct'])){echo ' invalid-visible correct';}?>"><?php if(isset($_SESSION['e_logon'])){ echo $_SESSION['e_logon'];}else if(isset($_SESSION['l_error'])){echo $_SESSION['l_error'];}else if (isset($_SESSION['d_correct'])){echo $_SESSION['d_correct'];}?></div>
                                        <div class="wrapp-input">
                                            <div class="label-input-form">
                                                <input class="form-control<?php if(isset($_SESSION['e_logon'])) echo ' is-invalid'?>" type="text" name="l_login" spellcheck="false"
                                                <?php if(isset($_SESSION['fl_login'])){echo "value='".$_SESSION['fl_login']."'";}else if(isset($_COOKIE['login'])){echo "value='".$_COOKIE['login']."'";}?>/>
                                                <label for="l_login">Login lub e-mail</label>
                                                <span class="icon-input"><i class="icon-user"></i></span>
                                            </div>
                                        </div>
                                        <div class="wrapp-input">
                                            <div class="label-input-form">
                                                <input class="form-control pr-input <?php if(isset($_SESSION['e_logon'])) echo ' is-invalid'?>" type="password" name="l_pass" spellcheck="false" <?php if(isset($_COOKIE['pass'])){echo "value='".$_COOKIE['pass']."'";}?>/>
                                                <label for="l_pass">Hasło</label>
                                                <span class="icon-input-second"><i class="icon-eye"></i></span>
                                                <span class="icon-input"><i class="icon-lock"></i></span>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1" name="remember-me" <?php if(isset($_SESSION['fl_remember-me'])){echo "checked='".$_SESSION['fl_remember-me']."'";}else if(isset($_COOKIE['checked'])){if(isset($_SESSION['e_logon'])){echo "";}else{echo "checked='".$_COOKIE['checked']."'";};}?>>
                                            <label class="custom-control-label" for="customCheck1">Zapamiętaj moje dane</label>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Zaloguj się</button>
                                    </form>
                                    <div id="login-via-social-media">
                                        <div class="label-login"><p id="social-media-alternative">LUB</p></div>
                                        <a class="google-login" href="<?php echo $gloginURL?>">
                                            <button class="btn btn-primary google-btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 48 48"><defs><path id="a" d="M44.5 20H24v8.5h11.8C34.7 33.9 30.1 37 24 37c-7.2 0-13-5.8-13-13s5.8-13 13-13c3.1 0 5.9 1.1 8.1 2.9l6.4-6.4C34.6 4.1 29.6 2 24 2 11.8 2 2 11.8 2 24s9.8 22 22 22c11 0 21-8 21-22 0-1.3-.2-2.7-.5-4z"/></defs><clipPath id="b"><use xlink:href="#a" overflow="visible"/></clipPath><path clip-path="url(#b)" fill="#FBBC05" d="M0 37V11l17 13z"/><path clip-path="url(#b)" fill="#EA4335" d="M0 11l17 13 7-6.1L48 14V0H0z"/><path clip-path="url(#b)" fill="#34A853" d="M0 37l30-23 7.9 1L48 0v48H0z"/><path clip-path="url(#b)" fill="#4285F4" d="M48 48L17 24l-4-3 35-10z"/></svg>
                                                <p>Kontynuuj przez Google</p>
                                            </button>
                                        </a>
                                        <a class="facebook-login" href="<?php echo $floginURL?>">
                                            <button class="btn btn-primary facebook-btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24"><path fill="#FFF" d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/></svg>
                                                <p>Kontynuuj przez Facebook</p>
                                            </button>
                                        </a>
                                        <div class="label-login"></div>
                                        <div id="reminder"><a href="">Nie pamiętam loginu, adresu e-mail lub hasła</a></div>
                                    </div>
                                </div>
                            </div>
                            <div id="register-wrapper" class="col-12 col-sm-10 col-md-6<?php if(!isset($_SESSION['space'])) echo ' hidden-el'?>">
                                <div id="register-form">
                                    <h5>ZAREJESTRUJ SIĘ</h5>
                                    <form id="register-system" action="register.php" method="POST">
                                        <div class="invalid-feedback<?php if(isset($_SESSION['e_register'])||isset($_SESSION['r_error'])) echo ' invalid-visible'?>"><?php if(isset($_SESSION['e_register'])){echo $_SESSION['e_register'];}else if(isset($_SESSION['r_error'])){echo $_SESSION['r_error'];}?></div>
                                        <div class="wrapp-input<?php if(isset($_SESSION['er_mail'])) echo ' alert-validate error-alert'?>">
                                            <div class="label-input-form">
                                                <input class="form-control <?php if(isset($_SESSION['er_mail'])) echo ' is-invalid'?>" type="text" name="r_mail" spellcheck="false" <?php if(isset($_SESSION['fr_mail'])){echo "value='".$_SESSION['fr_mail']."'";}?>/>
                                                <label for="r_mail">E-mail</label>
                                                <span class="icon-input"><i class="icon-mail-alt"></i></span>
                                            </div>
                                            <div class="error-message"><?php if(isset($_SESSION['er_mail'])) echo $_SESSION['er_mail']?></div>
                                        </div>
                                        <div class="wrapp-input<?php if(isset($_SESSION['er_login'])) echo ' alert-validate error-alert'?>">
                                            <div class="label-input-form">
                                                <input class="form-control <?php if(isset($_SESSION['er_login'])) echo ' is-invalid'?>" type="text" name="r_login" spellcheck="false" <?php if(isset($_SESSION['fr_login'])){echo "value='".$_SESSION['fr_login']."'";}?>/>
                                                <label for="r_login">Login</label>
                                                <span class="icon-input"><i class="icon-user"></i></span>
                                            </div>
                                            <div class="error-message"><?php if(isset($_SESSION['er_login'])) echo $_SESSION['er_login']?></div>
                                        </div>
                                        <div class="wrapp-input<?php if(isset($_SESSION['er_pass'])) echo ' alert-validate error-alert'?>">
                                            <div class="label-input-form">
                                                <input class="form-control <?php if(isset($_SESSION['er_pass'])) echo ' is-invalid'?>" type="password" name="r_pass" spellcheck="false"/>
                                                <label for="r_pass">Hasło</label>
                                                <span class="icon-input"><i class="icon-lock"></i></span>
                                            </div>
                                            <div class="error-message"><?php if(isset($_SESSION['er_pass'])) echo $_SESSION['er_pass']?></div>
                                        </div>
                                        <div class="wrapp-input<?php if(isset($_SESSION['er_pass2'])) echo ' alert-validate error-alert'?>">
                                            <div class="label-input-form">
                                                <input class="form-control <?php if(isset($_SESSION['er_pass2'])) echo ' is-invalid'?>" type="password" name="r_pass2" spellcheck="false"/>
                                                <label for="r_pass2">Powtórz hasło</label>
                                                <span class="icon-input"><i class="icon-lock"></i></span>
                                            </div>
                                            <div class="error-message"><?php if(isset($_SESSION['er_pass2'])) echo $_SESSION['er_pass2']?></div>
                                        </div>
                                        <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response"/>
                                        <button type="submit" class="btn btn-primary" name="form-register">Zarejestruj się</button>
                                        <div id="privacy-policy-agreement">
                                            <p>Zakładając konto akceptuję <span>Polityke prywatności</span></p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div id="toggle-form" class="<?php if(isset($_SESSION['space'])) echo 'move-el'?>">
                                <div id="toggle-login-form" class="<?php if(!isset($_SESSION['space'])) echo ' hidden-el'?>">
                                    <i class="icon-user"></i>
                                    <h5>Posiadasz już konto?</h5>
                                    <div class="description">Masz już konto? Kliknij aby wpisać swoje dane.</div>
                                    <button class="btn btn-light" id="toggle-login">Zaloguj się</button>
                                </div>
                                <div id="toggle-register-form" class="<?php if(isset($_SESSION['space'])) echo ' hidden-el'?>">
                                    <i class="icon-user-plus"></i>
                                    <h5>Nie posiadasz konta?</h5>
                                    <div class="description">Nie masz konta? Kliknij aby założyć konto.</div>
                                    <button class="btn btn-light" id="toggle-register">Zarejestruj się</button>
                                </div>
                                <div id="toggle-nav" class="col-12">
                                    <div class="toggle-nav-items col-6 <?php if(!isset($_SESSION['space'])) echo ' toggle-nav-items-focus'?>" id="toggle-nav-items-login">Logowanie</div>
                                    <div class="toggle-nav-items col-6 <?php if(isset($_SESSION['space'])) echo ' toggle-nav-items-focus'?>" id="toggle-nav-items-register">Rejestracja</div>
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
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('<?php echo SITE_KEY; ?>', {action: 'homepage'}).then(function(token) {
                document.getElementById('g-recaptcha-response').value=token;
            });
        });
    </script>
    <?php
        if(isset($_SESSION['l_error']))unset($_SESSION['l_error']);
        if(isset($_SESSION['e_logon']))unset($_SESSION['e_logon']);
        if(isset($_SESSION['e_register']))unset($_SESSION['e_register']);
        if(isset($_SESSION['er_mail']))unset($_SESSION['er_mail']);
        if(isset($_SESSION['er_login']))unset($_SESSION['er_login']);
        if(isset($_SESSION['er_pass']))unset($_SESSION['er_pass']);
        if(isset($_SESSION['er_pass2']))unset($_SESSION['er_pass2']);
        if(isset($_SESSION['r_error']))unset($_SESSION['r_error']);
        if(isset($_SESSION['space']))unset($_SESSION['space']);
        if(isset($_SESSION['d_correct']))unset($_SESSION['d_correct']);
        
    ?>
</body>
</html>