<?php
    if(!isset($_SESSION['online'])) {
        header('Location: index.php');
        exit();
    }
?>
<h4 class="user-data-header">Usuń konto</h4>
<div class="cnt-user-data">
    <form id="delete-account" action="delete-account.php" class="col-12 col-xl-11" method="POST">
        <div class="wrapper-user-data row feedback">
            <div class="name-user-data col-12 col-sm-4"></div>
            <div class="box-user-data col-12 col-sm-8">
                <div class="wrapp-input">
                    <div class="invalid-feedback
                        <?php 
                            if(isset($_SESSION['de_delete'])||isset($_SESSION['d_error'])) echo ' invalid-visible'?>">
                        <?php 
                            if(isset($_SESSION['de_delete'])){echo $_SESSION['de_delete'];}
                            else if(isset($_SESSION['d_error'])){echo $_SESSION['d_error'];}?>
                        <i class="icon-cancel"></i>    
                    </div>
                </div>
            </div>
        </div>
        <div class="wrapper-user-data row">
            <div class="name-user-data col-12 col-sm-4">Login lub e-mail</div>
            <div class="box-user-data col-12 col-sm-8">
                <div class="wrapp-input">
                    <div class="label-input-form">
                        <input class="form-control <?php if(isset($_SESSION['de_delete'])) echo ' is-invalid'?>" type="text" name="d_login" spellcheck="false"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="wrapper-user-data row">
            <div class="name-user-data col-12 col-sm-4">Hasło</div>
            <div class="box-user-data col-12 col-sm-8">
                <div class="wrapp-input">
                    <div class="label-input-form">
                        <input class="form-control <?php if(isset($_SESSION['de_delete'])) echo ' is-invalid'?>" type="password" name="d_pass" spellcheck="false"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="wrapper-user-data row justify-content-end">
            <button type="submit" class="btn btn-primary delete-btn col-12 col-sm-4 col-3">Usuń konto</button>
        </div>
        <div class="confirm-data" id="confirm-data-delete">
            <div class="col-12 col-lg-6 confirm-data-cnt">
                <div class="confirm-data-close"><i class="icon-cancel"></i></div>
                <div class="confirm-cnt col-12">
                    <h5>POTWIERDŹ ZMIANE</h5>
                    <h6>Czy napewno chcesz usunąć konto?</h6>
                    <button type="submit" class="btn btn-primary delete-btn-confirm">Usuń konto</button>
                </div>
            </div>
        </div>
    </form>
</div>