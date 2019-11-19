var root='/alumnus';


logout = function() {
    document.cookie = "user=0%3B0;path=/";
    document.location = root;
};

function gallery(){
    document.location = root+'/public/gallery';
}
function public(){
    document.location = root;
}
function events(){
    document.location = root+'/public/events';
}
function profile(){
    document.location = root+'/public/profile';
}
function settings(){
    document.location = root+'/public/gestion';
}

function patchnote(){
    document.location = root+'/public/gestion/notes';
}

//fonction liées à la page "gestion"
function settings_events(){
    document.location = root+'/public/gestion/events';
}
function settings_gallery(){
    document.location = root+'/public/gestion/gallery';
}
function settings_users(){
    document.location = root+'/public/gestion/users';
}

//fonction liées à la page "gestion/events"
function events_edit(id){
    document.location = root+'/public/gestion/events/editform.php?id='+id;
}
function events_del(id){
    if(confirm('Vous êtes sûr(e) de vouloir supprimer cet évènement ?')){
        document.location = root+'/app/trait/events_del.php?id='+id;
    }
}

//fonction liées à la page "gestion/gallery"
function gallery_edit(id){
    document.location = root+'/public/gestion/gallery/editform.php?id='+id;
}

function gallery_del(id){
    if(confirm('Vous êtes sûr(e) de vouloir supprimer cet image ?')){
        document.location = root+'/src/trait/gallery_del.php?id='+id;
    }
}

//fonction liées à la page "gestion/users"
function users_edit(id){
    document.location = root+'/public/gestion/users/editform.php?id='+id;
}

function users_sendmail(id){
    document.location = root+'/public/gestion/users/sendmail.php?id='+id;
}

function users_del(id){
    if(confirm('Vous êtes sûr(e) de vouloir supprimer cet utilisateur ?')){
        document.location = root+'/app/trait/users_del.php?id='+id;
    }
}

function users_resetpwd(id){
    if(confirm('Vous êtes sûr(e) de vouloir réinitialiser le mot de passe de cet utilisateur ?')){
        document.location = root+'/app/trait/users_resetpwd.php?id='+id;
    }
}
