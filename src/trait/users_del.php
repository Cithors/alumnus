<?php
    $INFO = ['/alumnus',''];
    include $_SERVER['DOCUMENT_ROOT'].$INFO[0].'/app/var.php';
    include $USERS;
    $id = $_GET['id'];
    $user = new Users();
    $user->deluser($id);
