<?php
    $INFO = ['/alumnus',''];
    include $_SERVER['DOCUMENT_ROOT'].$INFO[0].'/app/var.php';
    if(isset($_POST['obj'])){
        include $USERS;
        $users = new Users();
        $users->sendmailusers($_POST['id'],$_POST['obj'],$_POST['in']);
    }else{
        echo '<script>alert("'.$MSG_TRAIT_NODATA.'");</script>';
    }
