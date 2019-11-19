<?php
    $INFO = ['/alumnus','settings_events'];
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
?>
    <div align="center">
        <form action="<?=$ROOT;?>/app/trait/events_add.php" method="post">
            <input type="text" name="title" id="title" placeholder="Titre" required>
            <input type="text" name="desc" id="desc" placeholder="Description" required>
            <input type="date" name="sdate" id="sdate" min="<?=$DATE?>" required>
            <input type="date" name="edate" id="edate" min="<?=$DATE?>" required>
            <input type="url" name="pic" id="pic" placeholder="url de l'image" required>
            <button type="submit">Ajouter cet évènement</button>
        </form>
    </div>
<?php
    $events->printevents('s');

    include $FOOTER;
?>
