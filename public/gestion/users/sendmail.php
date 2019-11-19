<?php
    $INFO = ['/alumnus','settings_users_sendmail'];
    include $_SERVER['DOCUMENT_ROOT'].$INFO[0].'/app/var.php';
    include $USERS;
    $users = new Users();
    include $HEADER;
    include $TOOLS;
    if(isset($_COOKIE['msg'])){
        echo '<script>alert("'.$_COOKIE['msg'].'");</script>';
    }
    if(!isset($_COOKIE['user']) || $_COOKIE['user']=='0;0'){
        header("location: $LOGIN");
    }
    if(isset($_COOKIE['user'])){
        $ROLE = explode(';',$_COOKIE['user']);
        $ROLE = $ROLE[1];
        if($ROLE=='u'){
            setcookie('msg',"Impossible d'accéder à la page gestion sans les droits administrateurs !",time()+1,'/');
            header("location: $HOME");
        }
    }
?>
    <div align="center">
        <form action="<?= TRAITS ?>users_sendmail.php?id=" method="post">
            <input name="id" id="id" value="<?=$_GET['id'];?>" hidden>
            Object : <input type="text" name="obj" id="obj" placeholder="object">
            <br><br>
            Contenu : <textarea name="in" id="in" placeholder="contenu"></textarea>
            <br><br>
            <button type="submit">Envoyer</button>
        </form>
    </div>
<?php
    include $FOOTER;
?>
