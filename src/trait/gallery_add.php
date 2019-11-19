<?php
    $INFO = ['/alumnus',''];
    include $_SERVER['DOCUMENT_ROOT'].$INFO[0].'/app/var.php';
    if(isset($_POST['title'])){
        include $GALLERY;
        $gallery = new Gallery();
        $gallery->setTitle($_POST['title']);
        $gallery->setDesc($_POST['desc']);
        $gallery->setPic($_POST['pic']);
        $gallery->addgallery();
    }else{
        echo '<script>alert("'.$MSG_TRAIT_NODATA.'");</script>';
    }
