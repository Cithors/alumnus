<?php
    $INFO = ['/alumnus','settings_users_edit'];
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
    $tab = $users->getDataEdit($_GET['id']);
?>
    <div align="center">
        <form action="<?= TRAITS ?>users_edit.php" method="post">
            <input type="text" name="id" id="id" value="<?=$_GET['id'];?>" hidden>
            <input type="text" name="type" id="type" value="g" hidden>
            <h3>Nom: </h3>
            <input type="text" name="lastname" id="lastname" value="<?=$tab['lastname'];?>">
            <h3>Prénom: </h3>
            <input type="text" name="firstname" id="firstname" value="<?=$tab['firstname'];?>">
            <h3>Date de naissance: </h3>
            <input type="date" max="<?=$DATE;?>" name="birth" id="birth" value="<?=$tab['birth'];?>">
            <br><br>
            <button type="submit">Valider</button>
        </form>
    </div>
<?php
    include $FOOTER;
?>
