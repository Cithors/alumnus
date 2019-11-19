<?php
    $INFO = ['/alumnus',''];
    include $_SERVER['DOCUMENT_ROOT'].$INFO[0].'/app/var.php';
    include $EVENTS;
    $id = $_GET['id'];
    $event = new Events();
    $event->delevent($id);
