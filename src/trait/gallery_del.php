<?php
    $INFO = ['/alumnus',''];
    include $_SERVER['DOCUMENT_ROOT'].$INFO[0].'/app/var.php';
    include $GALLERY;
    $id = $_GET['id'];
    $gallery = new Gallery();
    $gallery->delgallery($id);
