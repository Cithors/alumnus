<?php
    $INFO = ['/alumnus',''];
    include $_SERVER['DOCUMENT_ROOT'].$INFO[0].'/app/var.php';
    if(isset($_POST['title'])){
        include $GALLERY;
        $gallery = new Gallery();
        $gallery->setTitle($_POST['title']);
        $gallery->setDesc($_POST['description']);
        $gallery->setPic($_POST['pic']);
        $gallery->editgallery($_POST['id']);
    }else{
        echo '<script>alert("'.$MSG_TRAIT_NODATA.'");</script>';
    }
