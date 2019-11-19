<?php
class Events{
    //chemin absolu
    public $ROOT='/alumnus';

    //variables
    protected $_Title;
    protected $_Desc;
    protected $_Sdate;
    protected $_Edate;
    protected $_Pic;

    //setter
    public function setTitle($Title){
        $this->_Title = $Title;
    }
    public function setDesc($Desc){
        $this->_Desc = $Desc;
    }
    public function setSdate($Sdate){
        $this->_Sdate = $Sdate;
    }
    public function setEdate($Edate){
        $this->_Edate = $Edate;
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
    public function getSdate(){
        return $this->_Sdate;
    }
    public function getEdate(){
        return $this->_Edate;
    }
    public function getPic(){
        return $this->_Pic;
    }

    //fonction pour afficher tous les évènements
    public function printevents($case){
        //pour $case, 2 choix possible "v"=>"vue" & "s"=>"settings"
        $database = $this->database();
        $request = $database->query("SELECT * FROM events");
        $result = $request->fetchall();
        foreach($result as $data){
            $sdate = explode('-',$data['sdate']);
            $sdate = [$sdate[2],$sdate[1],$sdate[0]];
            $sdate = implode('/',$sdate);
            $edate = explode('-',$data['edate']);
            $edate = [$edate[2],$edate[1],$edate[0]];
            $edate = implode('/',$edate);
            echo '
            <fieldset>
                <legend>'.$data['title'].'</legend>
                <div class="event-left">
                    <img src="'.$data['pic'].'" alt="event-pic-'.$data['id'].'" class="event-pic">
                </div>
                <div style="float:center;">
                ';
                if($sdate == $edate){
                    echo '<h5>Le '.$sdate.'</h5>';
                }else{
                    echo '<h5>Du '.$sdate.' au '.$edate.'</h5>';
                }
                echo'
                    <p>'.$data['description'].'</p>
                    </div>
                ';
                if($case=='s'){
                    echo '
                        <div>
                            <form action="'.$this->ROOT.'/home/gestion/events/editform.php" method="post" style="float:left;">
                                <button class="btn-edit" id="id-event" name="id-event" type="submit" value="'.$data['id'].'">Modifier</button>
                            </form>
                            <button class="btn-del" onclick="events_del('.$data['id'].')">Supprimer</button>
                        </div>
                    ';
                }
                echo '
            </fieldset>
            ';
        }
    }

    public function allEvents($date){
        global $admin;
        $database = $this->database();
        $request = $database->query("SELECT * FROM events");
        if ($result = $request->fetchall()) {
            foreach($result as $data){
                $class = (end($result) !== $data) ? ' class="last"' : '';
                $sdate = date_create($data['sdate']);
                $edate = date_create($data['edate']);
                $diff = date_diff($sdate, $edate);
                echo '
                <article'.$class.'>
                    <div class="current-date">';
                    if ($sdate == $edate){
                        echo '<p>'.$date['m'][date_format($sdate,"m")].'</p><p class="date">'.date_format($sdate,"d").'</p>';
                    } else{
                        echo '<p>'.$date['from'].$date['m'][date_format($sdate,"m")].'</p><p class="date">'.date_format($sdate,"d").'</p>';
                        echo '<p>'.$date['to'].$date['m'][date_format($edate,"m")].'</p><p class="date">'.date_format($edate,"d").'</p>';
                    }
                    echo'
                    </div>

                    <div class="img-left">
                        <a data-fancybox="gallery" href="'.$data['pic'].'">
                            <img src="'.$data['pic'].'" alt="pic-'.$data['id'].'" class="pic">
                        </a>
                    </div>

                    <div class="info">
                        <h3>'.$data['title'].'</h3>
                        <p class="info-line">
                            <span class="time">'.intval($diff->format('%a')+1).$date['d']['name'].'</span>
                            <span class="place">Lycée</span>
                        </p>

                        <p>'.$data['description'].'</p>';
                    if (isUser() == -1) {
                        echo '
                            <div>
                                <a onclick="createCookie2(\'id2\', '.$data['id'].', 3600)" class="btn green">'.$admin['mod'].'</a>
                                <form action="" method="post">
                                    <input name="del2" value="'.$data['id'].'" hidden>
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
    public function detailevent($id){
        $database = $this->database();
        $request = $database->query("SELECT * FROM events WHERE id=$id");
        $result = $request->fetch();
        return $result;
    }

    //fonction pour supprimer un évènement
    public function delevent($id){
        $database = $this->database();
        $request = $database->query("DELETE FROM events WHERE id='$id'");
        header("location: ".$_SERVER['HTTP_REFERER']);
    }

    //fonction pour récupérer les données d'un évènement
    public function getDataEdit($id){
        $database = $this->database();
        $request = $database->query("SELECT * FROM events WHERE id = '$id'");
        $result = $request->fetch();
        return $result;
    }
    //fonction pour ajouter un évènement
    public function addevent(){
        $database = $this->database();
        $request = $database->prepare("INSERT INTO events(title,description,sdate,edate,pic) VALUES (:t,:d,:sd,:ed,:p)");
        $result = $request->execute(['t'=>$this->getTitle(),'d'=>$this->getDesc(),'sd'=>$this->getSdate(),'ed'=>$this->getEdate(),'p'=>$this->getPic()]);
        $newsletter = $this->database();
        $request = $newsletter->query("SELECT * FROM news");
        $result = $request->fetchall();
        foreach ($result as $user){
            mail($user[1].'@lprs.fr', 'Nouvel évènement: '.$this->getTitle(), $this->getDesc());
        }
        header("location: ".$_SERVER['HTTP_REFERER']);
    }
    //fonction pour modifier un évènement

    public function modevent($id){
        $database = $this->database();
        $request = $database->prepare("UPDATE events SET title=:t, description=:d, sdate=:sd, edate=:ed, pic=:p WHERE id='$id'");
        $result = $request->execute(['t'=>$this->getTitle(),'d'=>$this->getDesc(),'sd'=>$this->getSdate(),'ed'=>$this->getEdate(),'p'=>$this->getPic()]);
        setcookie('msg',"L'évènement à été modifié !",time()+1,'/');
        setcookie('id2','0',time()+1,'/');
        header("location: ".$_SERVER['HTTP_REFERER']);
    }

    //fonction pour accéder à la base de données
    private function database(){
        $database = new PDO('mysql:host=localhost;dbname=alumnus','root','');
        return $database;
    }
}
