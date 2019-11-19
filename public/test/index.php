<?php

// dossier de tests

include '../../classes/Users.php';

$user = new Users();
$user->setMail('big@boss.com');
$user->setOldMdp('test');
$user->setNewMdp('test');
$user->login();