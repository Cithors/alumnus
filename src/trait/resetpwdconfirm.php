<?php
    $INFO = ['/alumnus',''];
    include $_SERVER['DOCUMENT_ROOT'].$INFO[0].'/app/var.php';
    include $USERS;
    $code = $_POST['code'];
    $users = new Users();
    $users->resetpwdmail($code);
