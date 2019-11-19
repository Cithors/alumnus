<?php
    $INFO = ['/alumnus','reset_pwd'];
    include $_SERVER['DOCUMENT_ROOT'].$INFO[0].'/app/var.php';
    include $HEADER;
    if(isset($_COOKIE['msg'])){
        echo '<script>alert("'.$_COOKIE['msg'].'");</script>';
    }
    if(isset($_COOKIE['user'])){
        $tab = explode(';',$_COOKIE['user']);
        if($tab[1]!='0'){
            setcookie('msg','Vous êtes déjà connecté(e) !',time()+1,'/');
            header("location: $HOME");
        }
    }
?>
    <div class="login" align="center">
        <form action="<?= TRAITS ?>resetpwd.php" method=post>
            <h4>Entrez le préfixe de votre adresse mail lprs</h4>
            <input type="text" name="mail" id="mail" required>@lprs.fr
            <br><br>
            <button type="submit">Se connecter !</button>
        </form>
    </div>
<?php include $FOOTER; ?>
