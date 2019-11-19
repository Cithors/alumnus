<?php
class Gallery{
    //chemin absolu
    public $ROOT='/alumnus';

    //variables
    protected $_Title;
    protected $_Desc;
    protected $_Pic;

    //setter
    public function setTitle($Title){
        $this->_Title = $Title;
    }
    public function setDesc($Desc){
        $this->_Desc = $Desc;
    }
    public function setPic($Pic){
        $this->_Pic = $Pic;
    }

    //getter
    public function getTitle(){
        return $this->_Title;
    }
    public function getDesc(){
        return $this->_Desc;
    }
    public function getPic(){
        return $this->_Pic;
    }

    //fonction pour afficher tous les évènements
    public function allImages(){
        global $admin;
        $database = $this->database();
        $request = $database->query("SELECT * FROM gallery");
        if ($result = $request->fetchall()) {
            foreach($result as $data){
                $class = (end($result) !== $data) ? ' class="last"' : '';
                echo '
                <article'.$class.'>
                    <div class="img-left">
                        <a data-fancybox="gallery" href="'.$data['pic'].'">
                            <img src="'.$data['pic'].'" alt="pic-'.$data['id'].'" class="pic">
                        </a>
                    </div>

                    <div class="info">
                        <h3>'.$data['title'].'</h3>
                        <p class="info-line">
                            <span class="place">Lycée</span>
                        </p>

                        <p>'.$data['description'].'</p>';
                    if (isUser() == -1) {
                        echo '
                            <div>
                                <a onclick="createCookie2(\'id\', '.$data['id'].', 3600)" class="btn green">'.$admin['mod'].'</a>
                                <form action="" method="post" style="float:left;">
                                    <input name="del" value="'.$data['id'].'" hidden>
                                    <button class="btn red">'.$admin['del'].'</button>
                                </form>
                            </div>
                        ';
                    }
                    echo'
                    </div>
                </article>
                ';
            }
        } else {
            echo '<h2><i class="fa fa-warning"></i> Data Unavailable</h2>';
        }
    }

    //fonction pour récuperer les informations d'un élément
    public function detailgallery($id){
        //pour $case, 2 choix possible "v"=>"vue" & "s"=>"settings"
        $database = $this->database();
        $request = $database->query("SELECT * FROM gallery WHERE id=$id");
        $result = $request->fetch();
        return $result;
    }

    //fonction pour supprimer un évènement
    public function delgallery($id){
        $database = $this->database();
        $request = $database->query("DELETE FROM gallery WHERE id='$id'");
        header("location: ".$_SERVER['HTTP_REFERER']);
    }

    //fonction pour récupérer les données d'une "image"
    public function getDataEdit($id){
        $database = $this->database();
        $request = $database->query("SELECT * FROM gallery WHERE id = '$id'");
        $result = $request->fetch();
        return $result;
    }

    //fonction pour ajouter un évènement
    public function addgallery(){
        $database = $this->database();
        $request = $database->prepare("INSERT INTO gallery(title,description,pic) VALUES (:t,:d,:p)");
        $result = $request->execute(['t'=>$this->getTitle(),'d'=>$this->getDesc(),'p'=>$this->getPic()]);
        header("location: ".$_SERVER['HTTP_REFERER']);
    }

    //fonction pour modifier un évènement
    public function modgallery($id){
        $database = $this->database();
        $request = $database->prepare("UPDATE gallery SET title=:t, description=:d, pic=:p WHERE id='$id'");
        $result = $request->execute(['t'=>$this->getTitle(),'d'=>$this->getDesc(),'p'=>$this->getPic()]);
        setcookie('msg',"L'image à bien été modifiée !",time()+1,'/');
        setcookie('id','0',time()+1,'/');
        header("location: ".$_SERVER['HTTP_REFERER']);
    }

    //fonction pour accéder à la base de données
    private function database(){
        $database = new PDO('mysql:host=localhost;dbname=alumnus','root','');
        return $database;
    }
}
