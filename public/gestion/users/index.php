<?php
    $INFO = ['/alumnus','settings_users'];
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
    <form action="<?=$ROOT;?>/app/trait/users_add.php" method="post">
            <input type="text" name="nickname" id="nickname" placeholder="Pseudo" required>
            <input type="text" name="lastname" id="lastname" placeholder="Nom de famille" required>
            <input type="text" name="firstname" id="firstname" placeholder="Prénom" required>
            <input type="date" name="birth" id="birth" required>
            <input type="text" name="mail" id="mail" placeholder="mail" required>@lprs.fr
            <button type="submit">Ajouter cet utilisateur</button>
        </form>
    </div>
<?php
    $users->printusers('s');

    include $FOOTER;
?>
