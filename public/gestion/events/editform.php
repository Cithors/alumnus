<?php
    $INFO = ['/alumnus','settings_events_edit'];
    include $_SERVER['DOCUMENT_ROOT'].$INFO[0].'/app/var.php';
    include $EVENTS;
    $events = new Events();
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
    $tab = $events->getDataEdit($_POST['id-event']);

?>
    <div align="center">
        <form action="<?= TRAITS ?>events_edit.php" method="post">
            <input type="text" name="id" id="id" value="<?=$_POST['id-event'];?>" hidden>
            <h3>Titre: </h3>
            <input type="text" name="title" id="title" value="<?=$tab['title'];?>">
            <h3>Description: </h3>
            <input type="text" name="description" id="description" value="<?=$tab['description'];?>">
            <h3>Date de début</h3>
            <input type="date" min="<?=$DATE;?>" name="sdate" id="sdate" value="<?=$tab['sdate'];?>">
            <h3>Date de fin</h3>
            <input type="date" min="<?=$DATE;?>" name="edate" id="edate" value="<?=$tab['edate'];?>">
            <h3>Url: </h3>
            <input type="url" name="pic" id="pic" value="<?=$tab['pic'];?>">
            <br><br>
            <button type="submit">Valider</button>
        </form>
    </div>
<?php
    include $FOOTER;
?>
