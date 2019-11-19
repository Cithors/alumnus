<?php
    $INFO = ['/alumnus','notes'];
    include $_SERVER['DOCUMENT_ROOT'].$INFO[0].'/app/var.php';
    include $USERS;
    $user = new Users();
    include $HEADER;
    include $TOOLS;
    if(isset($_COOKIE['msg'])){
        echo '<script>alert("'.$_COOKIE['msg'].'");</script>';
    }
    if(!isset($_COOKIE['user']) || $_COOKIE['user']=='0;0'){
        header("location: $LOGIN");
    }
    if(isset($_COOKIE['user'])){
        $ROLE = explode(';',$_COOKIE['user']);
        $ROLE = $ROLE[1];
        if($ROLE=='u'){
            setcookie('msg',"Impossible d'accéder à la page gestion sans les droits administrateurs !",time()+1,'/');
            header("location: $HOME");
        }
    }
?>
    <div align="center">
        <h3>- - - - - v0.1 - - - - -</h3>
        <div>
            <li>Connexion/déconnexion</li>
            <li>Header</li>
            <li>Profil</li>
        </div>
        <h3>- - - - - v0.2 - - - - -</h3>
        <div>
            <li>Évènements</li>
            <li>Notes de versions</li>
        </div>
        <h3>- - - - - v0.3 - - - - -</h3>
        <div>
            <li>Gestion [events(add,del)]</li>
            <li>Gestion [gallery(add,del)]</li>
            <li>Gestion [users(add)] => Inscription</li>
            <li>Liste users</li>
            <li>Gallerie</li>
        </div>
        <h3>- - - - - v0.4 - - - - -</h3>
        <div>
            <li>Gestion [users(del)]</li>
        </div>
        <h3>- - - - - v0.5 - - - - -</h3>
        <div>
            <li>Envoi de mail (reset pwd)</li>
            <li>Envoi de mail (user)</li>
        </div>
        <h3>- - - - - v0.6 - - - - -</h3>
        <div>
            <li>Gestion [events(edit)]</li>
            <li>Gestion [gallery(edit)]</li>
            <li>Gestion [users(edit)]</li>
            <li>User (edit)</li>
        </div>
        <h3>- - - - - TODO (TRIÉ PAR ORDRE DE PRIORITÉ) - - - - -</h3>
        <div>
            <li>Footer</li>
            <li>Accueil user (home)</li>
            <li>Accueil guest (racine)</li>
            <li>Refonte graphique (sous bootstrap) + responsive</li>
            <li>Chat entre utilisateur</li>
        </div>
    </div>
<?php
    include $FOOTER;
?>
