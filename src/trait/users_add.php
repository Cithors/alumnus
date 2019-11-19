<?php
    $INFO = ['/alumnus',''];
    include $_SERVER['DOCUMENT_ROOT'].$INFO[0].'/app/var.php';
    if(isset($_POST['nickname'])){
        include $USERS;
        $users = new Users();
        $users->setNickname($_POST['nickname']);
        $users->setFirstname($_POST['firstname']);
        $users->setLastname($_POST['lastname']);
        $users->setBirth($_POST['birth']);
        $users->setMail($_POST['mail']);
        $users->adduser();
    }else{
        echo '<script>alert("'.$MSG_TRAIT_NODATA.'");</script>';
    }
