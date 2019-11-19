<?php
class Users {
    //chemin absolu
    public $ROOT='/alumnus';

    //variables
    protected $_user;
    protected $_nickname;
    protected $_firstname;
    protected $_lastname;
    protected $_pwd;
    protected $_birth;
    protected $_mail;

    // 444bcb3a3fcf8389296c49467f27e1d6: ok

    //setter
    public function setNickname($nickname){
        $this->_nickname = $nickname;
    }
    public function setFirstname($firstname){
        $this->_firstname = $firstname;
    }
    public function setLastname($lastname){
        $this->_lastname = $lastname;
    }
    public function setPwd($pwd){
        $this->_pwd = $pwd;
    }
    public function setBirth($birth){
        $this->_birth = $birth;
    }
    public function setMail($mail){
        $this->_mail = $mail;
    }

    //getter
    public function getNickname(){
        return $this->_nickname;
    }
    public function getFirstname(){
        return $this->_firstname;
    }
    public function getLastname(){
        return $this->_lastname;
    }
    public function getPwd(){
        return $this->_pwd;
    }
    public function getBirth() {
        return $this->_birth;
    }
    public function getMail() {
        return $this->_mail;
    }

    //fonction pour se connecter
    public function login(){
        // global $wrongMsg;
        // global $userMsg;
        $database = $this->database();
        $nickname = $this->getNickname();
        $pwd = $this->getPwd();
        $request = $database->query("SELECT id, mail, role, pwd as 'db_pwd' FROM users WHERE nickname='$nickname'");
        if ($result = $request->fetch()) {
            //vérification du mot de passe
            if ($result['db_pwd'] != 'change') {
                if (password_verify($pwd, $result['db_pwd'])) {
                    $chain = ['id'=>$result['id'], 'role'=>$result['role']];
                    $chain = implode(';',$chain);
                    setcookie('user', $chain, time()+3600,'/');
                    header("location: ".HOME);
                } else {
                    setcookie('msg', 'wrong', time()+4, '/');
                    header("location: ".$_SERVER['HTTP_REFERER']);
                }
            } else {
            	$database2 = $this->database();
                if ($database->query("SELECT id FROM users WHERE nickname='$nickname'")->fetch()) setcookie('code', '1', time()+4, '/');
                // setcookie('mail', $result['db_pwd'], time()+4,'/');
            	$_SESSION['mail'] = $result['mail'];
                header("location: ".$_SERVER['HTTP_REFERER']);
            }
        } else {
        	setcookie('msg', 'wrong', time()+4,'/');
        	header("location: ".$_SERVER['HTTP_REFERER']);
        }
    }

    //fonction pour afficher le profil
    public function profile() {
        $database = $this->database();
        if(isset($_COOKIE['user'])){
            $tab = explode(';',$_COOKIE['user']);
            $id = $tab[0];
            $request = $database->query("SELECT * FROM users WHERE id='$id'");
            $result = $request->fetch();
            echo '
                <table align="center">
                    <tr align="center">
                        <td>NOM</td>
                        <td>Prénom</td>
                        <td>Date de naissance</td>
                        <td>Adresse mail</td>
                    </tr>
                    <tr align="center">
                        <td>'.strtoupper($result['lastname']).'</td>
                        <td>'.ucfirst(strtolower($result['firstname'])).'</td>
                        <td>'.$result['birth'].'</td>
                        <td>'.$result['mail'].'@lprs.fr</td>
                    </tr>
                    <tr align="center">
                        <td colspan="4">
                            <a href="'.$this->ROOT.'/public/profile/editform.php?id='.$id.'">
                                <button>Changer mes informations</button>
                            </a>
                        </td>
                    </tr>
                </table>
            ';
        }
    }

    //fonction pour afficher le profil
    public function showProfile($userGet = null) {
        $database = $this->database();
        if (isset($_COOKIE['user'])) {
            $tab = explode(';', $_COOKIE['user']);
            $id = $tab[0];
            $request = $database->query("SELECT * FROM users WHERE id = '$id'");
            $result = $request->fetch();
            if ($userGet) {
                return $result;
            }
            echo '
                <div class="table">
                    <table align="center">
                        <tr align="center">
                            <td>NOM</td>
                            <td>Prénom</td>
                            <td>Date de naissance</td>
                            <td>Adresse mail</td>
                        </tr>
                        <tr align="center">
                            <td>'.strtoupper($result['lastname']).'</td>
                            <td>'.ucfirst(strtolower($result['firstname'])).'</td>
                            <td>'.$result['birth'].'</td>
                            <td>'.$result['mail'].'@lprs.fr</td>
                        </tr>
                        <tr align="center">
                            <td colspan="4">
                                <a href="'.$this->ROOT.'/public/profile/editform.php?id='.$id.'">
                                    <button>Changer mes informations</button>
                                </a>
                            </td>
                        </tr>
                    </table>
                </div>
            ';
        }
    }

    //fonction pour récuperer les données du profil
    public function getDataEdit($id) {
        $database = $this->database();
        $request = $database->query("SELECT * FROM users WHERE id = '$id'");
        $result = $request->fetch();
        return $result;
    }

    //fonction pour récuperer l'id d'un utilisateur qui réinitialise son mot de passe
    public function getUserId($mail){
        $database = $this->database();
        $request = $database->query("SELECT id FROM users WHERE mail = '$mail' AND pwd = 'change'");
        $result = $request->fetch();
        return $result;
    }

    //fonction pour afficher tous les utilisateurs
    public function printusers(){
        $database = $this->database();
        $request = $database->query("SELECT * FROM users");
        $result = $request->fetchall();
        foreach($result as $data){
            $birth = explode('-',$data['birth']);
            $birth = [$birth[2],$birth[1],$birth[0]];
            $birth = implode('/',$birth);
            echo '
            <fieldset>
                <legend>'.$data['nickname'].'</legend>
                <div>
                    <h5>'.strtoupper($data['lastname']).' '.ucfirst(strtolower($data['firstname'])).'</h5>
                    <p>'.$birth.'</p>
                    <button class="btn-edit" onclick="users_edit('.$data['id'].')">Modifier</button>
                    <button class="btn-del" onclick="users_del('.$data['id'].')">Supprimer</button>
                    <button class="btn-resetpwd" onclick="users_resetpwd('.$data['id'].')">Réinitialiser le mot de passe</button>
                    <button class="btn-sendmail" onclick="users_sendmail('.$data['id'].')">Envoyer un mail</button>
                </div>
            </fieldset>
            ';
        }
    }

    //fonction pour ajouter un utilisateur
    public function adduser(){
        $database = $this->database();
        $request = $database->prepare("INSERT INTO users(nickname,pwd,firstname,lastname,birth,mail,role) VALUES (:n,:p,:f,:l,:b,:m,:r)");
        $result = $request->execute(['n'=>$this->getNickname(),'p'=>'change','f'=>$this->getFirstname(),'l'=>$this->getLastname(),'b'=>$this->getBirth(),'m'=>$this->getMail(),'r'=>'u']);
        header("location: $this->ROOT/public/gestion/users/");
    }

    //fonction pour modifier un utilisateur
    public function edituser($id,$type){
        $database = $this->database();
        $request = $database->prepare("UPDATE users SET firstname=:f , lastname=:l , birth=:b WHERE id='$id'");
        $result = $request->execute(['f'=>$this->getFirstname(),'l'=>$this->getLastname(),'b'=>$this->getBirth()]);
        if ($type=='g') {
            setcookie('msg',"L'utilisateur à été modifié !",time()+1,'/');
            header("location: $this->ROOT/public/gestion/users/");
        } else {
            header("location: $this->ROOT/public/profile/");
        }
    }

    //fonction pour modifier un utilisateur
    public function modProfile($nick, $pwd){
        $id = explode(';', $_COOKIE['user'])[0];
        $pwd = password_hash($pwd, PASSWORD_BCRYPT, ['cost' => 10]);

        $database1 = $this->database();
        $request = $database1->query("SELECT * FROM users WHERE id='$id'");
        if ($result = $request->fetch()) {
            setcookie('msg', "yay", time()+4, '/');
            $database2 = $this->database();
            $request = $database2->query("UPDATE users SET nickname='$nick', pwd='$pwd' WHERE id='$id'");
        } else { setcookie('msg', "wrong $id", time()+4, '/'); }
        header("location: ".$_SERVER['HTTP_REFERER']);
    }

    public function modUser(){
        $database = $this->database();
        $request = $database->query("UPDATE users SET nickname='WeW', pwd='Helle' WHERE id='2'");
        // $result = $request->execute(['n'=>'WaW','p'=>'Hella']);
    }

    //fonction pour supprimer un utilisateur
    public function deluser($id){
        $database = $this->database();
        $request = $database->query("DELETE FROM users WHERE id='$id'");
        header("location: $this->ROOT/public/gestion/users/");
    }

    //fonction pour supprimer le mdp d'un utilisateur
    public function resetpwd($id){
        $database = $this->database();
        $request = $database->query("UPDATE users SET pwd='change' WHERE id='$id'");
        header("location: $this->ROOT/public/gestion/users/");
    }

    //fonction pour supprimer le mdp d'un utilisateur
    public function resetpwdmail($code){
        global $resetMsg;
        global $codeMsg;
        $database1 = $this->database();
        $request = $database1->query("SELECT mail FROM pwdreset WHERE code='$code'");
        if ($result = $request->fetch()) {
            $mail = $result['mail'];
            $database2 = $this->database();
            $request = $database2->query("UPDATE users SET pwd='change' WHERE mail='$mail'");
            // $database3 = $this->database();
            // $request = $database3->query("DELETE FROM pwdreset WHERE mail='$mail'");
            setcookie('msg', 'reset', time()+4, '/');
            setcookie('code', '2', time()+4, '/');
        } else {
            setcookie('msg', 'code', time()+4 ,'/');
            setcookie('code', '1', time()+4, '/');
        }
        header("location: ".$_SERVER['HTTP_REFERER']);
    }

    //fonction pour envoyer le mail de récupération
    public function sendmailreset($mail){
        global $mailMsg;
        global $wrongMsg;
        $database1 = $this->database();
        $request = $database1->query("SELECT * FROM users WHERE mail='$mail'");
        if ($result = $request->fetch()) {
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $code = substr(str_shuffle($chars),0,8);
            $database2 = $this->database();
            $request = $database2->query("INSERT INTO pwdreset(mail,code) VALUES ('$mail','$code')");
            mail($mail.'@lprs.fr', 'Réinitialisation du mot de passe', "Bonjour, vous avez demandé la réinitialisation du compte lié à cette adresse mail sur le site Alumnus.\nTapez le code suivant dans le formulaire récupération: $code");
            setcookie('msg', 'mail', time()+4, '/');
            // setcookie('mail', $mail, time()+4, '/');
            $_SESSION['mail'] = $mail;
            setcookie('code', '1', time()+4, '/');
        } else { setcookie('msg', 'wrong', time()+4, '/'); }
        header("location: ".$_SERVER['HTTP_REFERER']);
    }

    // Méthode pour envoyer le mail de récupération
    public function sendmailusers($id,$obj,$in){
        $database = $this->database();
        $request = $database->query("SELECT mail FROM users WHERE id='$id'");
        $result = $request->fetch();
        $mail = $result['mail'];
        setcookie('msg','Mail envoyé',time()+1,'/');
        mail($mail.'@lprs.fr',$obj,$in);
        header("location: $this->ROOT/public/gestion/users");
    }

    // Méthode pour envoyer le mail de récupération
    public function sendmailcontact($name,$mail,$type,$in){
        mail('admin@lprs.fr',$type.': '.$name.' ('.$mail.')',$in);
        header("location: ".$_SERVER['HTTP_REFERER']);
    }

    // Méthode pour changer le mot de passe (page profile)
    public function changepwd($id, $pwd1, $pwd2){
        global $changeMsg;
        if ($pwd1 == $pwd2) {
            $pwd1 = password_hash($pwd1, PASSWORD_BCRYPT, ['cost' => 10]);
            $database = $this->database();
            $request = $database->query("UPDATE users SET pwd='$pwd1' WHERE id='$id'");
            $database2 = $this->database();
            setcookie('msg', '', -1, '/');
            $request = $database3->query("DELETE FROM pwdreset WHERE mail = (SELECT mail FROM users WHERE id = '$id' LIMIT 1)");
            header("location: ".$_SERVER['HTTP_REFERER']);
        } else {
            setcookie('msg', 'change', time()+10,'/');
            header("location: ".$_SERVER['HTTP_REFERER']);
        }
    }

    //fonction pour accéder à la base de données
    private function database(){
        $database = new PDO('mysql:host=localhost;dbname=alumnus','root','');
        return $database;
    }
}
