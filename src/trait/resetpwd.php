<?php
    $INFO = ['/alumnus',''];
    include $_SERVER['DOCUMENT_ROOT'].$INFO[0].'/app/var.php';
    include $USERS;
    $mail = $_POST['mail'];
    $users = new Users();
    $users->sendmailreset($mail);
