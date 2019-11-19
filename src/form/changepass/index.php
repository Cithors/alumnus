<?php
    $INFO = ['/alumnus','change_pwd'];
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
        <form action="<?= TRAITS ?>changepwd.php" method=post>
            <input type="text" name="id" id="id" value="<?=$_GET['id'];?>" hidden>
            <h4>Mot de passe</h4>
            <input type="password" name="pwd1" id="pwd1" required>
            <h4>Confirmation du mot de passe</h4>
            <input type="password" name="pwd2" id="pwd2" required>
            <br><br>
            <button type="submit">Se connecter !</button>
        </form>
    </div>
<?php
    include $FOOTER;
?>
