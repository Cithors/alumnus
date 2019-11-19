<?php
    $INFO = ['/alumnus',''];
    include $_SERVER['DOCUMENT_ROOT'].$INFO[0].'/app/var.php';
    include $USERS;
    $id = $_POST['id'];
    $pwd1 = $_POST['pwd1'];
    $pwd2 = $_POST['pwd2'];
    if($pwd1 == $pwd2){
        $users = new Users();
        $users->changepwd($id, $pwd1);
    }
