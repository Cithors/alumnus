<?php
    $INFO = ['/alumnus',''];
    include $_SERVER['DOCUMENT_ROOT'].$INFO[0].'/app/var.php';
    if(isset($_POST['title'])){
        include $EVENTS;
        $event = new Events();
        $event->setTitle($_POST['title']);
        $event->setDesc($_POST['description']);
        $event->setPic($_POST['pic']);
        $event->setSdate($_POST['sdate']);
        $event->setEdate($_POST['edate']);
        $event->editevent($_POST['id']);
    }else{
        echo '<script>alert("'.$MSG_TRAIT_NODATA.'");</script>';
    }
