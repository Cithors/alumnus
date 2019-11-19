<?php
    $INFO = ['/alumnus','settings_gallery_edit'];
    include $_SERVER['DOCUMENT_ROOT'].$INFO[0].'/app/var.php';
    include $GALLERY;
    $gallery = new Gallery();
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
    $tab = $gallery->getDataEdit($_POST['id-gallery']);

?>
    <div align="center">
        <form action="<?= TRAITS ?>gallery_edit.php" method="post">
            <input type="text" name="id" id="id" value="<?=$_POST['id-gallery'];?>" hidden>
            <h3>Titre: </h3>
            <input type="text" name="title" id="title" value="<?=$tab['title'];?>">
            <h3>Description: </h3>
            <input type="text" name="description" id="description" value="<?=$tab['description'];?>">
            <h3>Url: </h3>
            <input type="url" name="pic" id="pic" value="<?=$tab['pic'];?>">
            <br><br>
            <button type="submit">Valider</button>
        </form>
    </div>
<?php
    include $FOOTER;
?>
