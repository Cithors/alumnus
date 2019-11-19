<?php
    $INFO = ['/alumnus',''];
    include '../var.php';
    if(isset($_POST['firstname'])){
        include $USERS;
        $users = new Users();
        $users->setFirstname($_POST['firstname']);
        $users->setLastname($_POST['lastname']);
        $users->setBirth($_POST['birth']);
        $users->edituser($_POST['id'],$_POST['type']);
    }else{
        echo '<script>alert("'.$MSG_TRAIT_NODATA.'");</script>';
    }
