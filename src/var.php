<?php
    //Récupération racine du site + nom de la page
    $ROOT=$INFO[0];
    $page=$INFO[1];

    //include block
    $HEADER = $_SERVER['DOCUMENT_ROOT'].$ROOT.'/app/block/header.php';
    $FOOTER = $_SERVER['DOCUMENT_ROOT'].$ROOT.'/app/block/footer.php';
    $TOOLS = $_SERVER['DOCUMENT_ROOT'].$ROOT.'/app/block/tools.php';

    //include class
    $USERS = '../classes/Users.php';
    $EVENTS = '../classes/Events.php';
    $GALLERY = '../classes/Gallery.php';

    //chemin absolu
    $LOGIN = $ROOT.'/login';
    $HOME = $ROOT.'/home';
    $TRAIT = $ROOT.'/app/trait/';
    $FORM = $ROOT.'/form';

    //variable pour le titre des pages
    $title = [
        'index'=>'Accueil - Invité',
        'login'=>'Connexion',
        'home'=>'Accueil - Utilisateur',
        'events'=>'Évènements',
        'gallery'=>'Gallerie',
        'profil'=>"Profil de l'utilisateur",
        'gestion'=>'Gestion',
        'notes'=>'Notes de version',
        'settings_events'=>'Gestion > Évènements',
        'settings_events_edit'=>'Gestion > Évènements > Édition',
        'settings_gallery'=>'Gestion > Gallerie',
        'settings_gallery_edit'=>'Gestion > Gallerie > Édition',
        'settings_users'=>'Gestion > Utilisateurs',
        'settings_users_edit'=>'Gestion > Utilisateurs > Édition',
        'settings_users_sendmail'=>'Gestion > Utilisateurs > Envoyer mail',
        'reset_pwd'=>'Demande de réinitialisation du mot de passe',
        'reset_pwd_confirm'=>'Confirmation de réinitialisation du mot de passe',
        'change_pwd'=>'Nouveau mot de passe'
    ];

    //include front
    $CSS = $ROOT.'/app/front/style.css';
    $JS = $ROOT.'/app/front/functions.js';

    //include img
    $LOGO = $ROOT.'/app/img/logo.png';

    //msg
    $MSG_TRAIT_NODATA = "Action impossible, aucune(s) donnée(s) reçue(s) !";

    //date
    $DATE = date('Y-m-d');
