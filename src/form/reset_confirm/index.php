<?php
    $INFO = ['/alumnus','reset_pwd_confirm'];
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
        <form action="<?= TRAITS ?>resetpwdconfirm.php" method=post>
            <h4>Entrez le code envoyé à votre adresse</h4>
            <input type="text" name="code" id="code" required>
            <br><br>
            <button type="submit">Accéder à mon compte</button>
    </div>
<?php
    include $FOOTER;
?>
