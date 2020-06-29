<h4 class="user-data-header">Usuń konto</h4>
<div class="cnt-user-data">
    <form id="delete-account" action="delete-account-others.php" class="col-12 col-xl-11" method="POST">
        <div class="wrapper-user-data row feedback">
            <div class="name-user-data col-12 col-sm-4"></div>
            <div class="box-user-data col-12 col-sm-8">
                <div class="wrapp-input">
                    <div class="invalid-feedback
                    <?php 
                        if(isset($_SESSION['de_delete'])||isset($_SESSION['d_error'])) echo ' invalid-visible'?>">
                    <?php 
                        if(isset($_SESSION['de_delete'])){echo $_SESSION['de_delete'];}
                        else if(isset($_SESSION['d_error'])){echo $_SESSION['d_error'];}?></div>
                </div>
            </div>
        </div>
        <div class="wrapper-user-data row justify-content-end">
            <button type="submit" class="btn btn-primary delete-btn col-12 col-sm-4 col-3">Usuń konto</button>
        </div>
        <div class="confirm-data" id="confirm-data-delete">
            <div class="col-12 col-lg-6 confirm-data-cnt">
                <div class="confirm-data-close"><i class="icon-cancel"></i></div>
                <div class="confirm-cnt col-12 col-xl-11">
                    <h5>POTWIERDŹ ZMIANE</h5>
                    <h6>Czy napewno chcesz usunąć konto?</h6>
                    <button type="submit" class="btn btn-primary delete-btn-confirm">Usuń konto</button>
                </div>
            </div>
        </div>
    </form>
</div>