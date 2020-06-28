<h4 class="user-data-header">Zmień hasło</h4>
<div class="cnt-user-data">
    <form id="change-account" action="change-pass-account.php" class="col-12 col-xl-11" method="POST">
        <div class="wrapper-user-data row feedback">
            <div class="name-user-data col-12 col-sm-4"></div>
            <div class="box-user-data col-12 col-sm-8">
                <div class="wrapp-input">
                    <div class="invalid-feedback
                    <?php 
                        if(isset($_SESSION['ep_logon'])||isset($_SESSION['p_error'])||isset($_SESSION['ep_change'])||isset($_SESSION['ep_pass2'])){echo ' invalid-visible';}
                        else if (isset($_SESSION['p_correct'])){echo ' invalid-visible correct';}?>">
                    <?php 
                        if(isset($_SESSION['ep_logon'])){echo $_SESSION['ep_logon'];}
                        else if(isset($_SESSION['p_error'])){echo $_SESSION['p_error'];}
                        else if (isset($_SESSION['p_correct'])){echo $_SESSION['p_correct'];}
                        else if(isset($_SESSION['ep_change'])){echo "Upewnij się, czy wpisane dane są poprawne";}
                        else if (isset($_SESSION['ep_pass2'])){echo "Upewnij się, czy wpisane dane są poprawne";}?></div>
                </div>
            </div>
        </div>
        <div class="wrapper-user-data row">
            <div class="name-user-data col-12 col-sm-4">Login lub e-mail</div>
            <div class="box-user-data col-12 col-sm-8">
                <div class="wrapp-input">
                    <div class="label-input-form">
                        <input class="form-control <?php if(isset($_SESSION['ep_logon'])) echo ' is-invalid'?>" type="text" name="p_login" spellcheck="false"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="wrapper-user-data row">
            <div class="name-user-data col-12 col-sm-4">Hasło</div>
            <div class="box-user-data col-12 col-sm-8">
                <div class="wrapp-input<?php if(isset($_SESSION['ep_change'])) echo ' alert-validate error-alert'?>">
                    <div class="label-input-form">
                        <input class="form-control <?php if(isset($_SESSION['ep_logon'])||isset($_SESSION['ep_change'])) echo ' is-invalid'?>" type="password" name="p_pass" spellcheck="false"/>
                    </div>
                    <div class="error-message"><?php if(isset($_SESSION['ep_change'])) echo $_SESSION['ep_change']?></div>
                </div>
            </div>
        </div>
        <div class="wrapper-user-data row">
            <div class="name-user-data col-12 col-sm-4">Nowe hasło</div>
            <div class="box-user-data col-12 col-sm-8">
                <div class="wrapp-input<?php if(isset($_SESSION['ep_pass2'])) echo ' alert-validate error-alert'?>">
                    <div class="label-input-form">
                        <input class="form-control <?php if(isset($_SESSION['ep_logon'])||isset($_SESSION['ep_change'])||isset($_SESSION['ep_pass2'])) echo ' is-invalid'?>" type="password" name="p_pass2" spellcheck="false"/>
                    </div>
                    <div class="error-message"><?php if(isset($_SESSION['ep_pass2'])) echo $_SESSION['ep_pass2']?></div>
                </div>
            </div>
        </div>
        <div class="wrapper-user-data row justify-content-end">
            <button type="submit" class="btn btn-primary col-12 col-sm-4 col-3">Zmień hasło</button>
        </div>
    </form>
</div>