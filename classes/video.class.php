<?php

class video{

    var $id;
    var $title;
    var $description;
    var $name;
    var $duration;
    var $type;
    var $show_home;
    var $added_date;
    var $status;

    // constructors
    function __construct(){}

    public function video($id){

        $query = sprintf("SELECT * FROM videos WHERE id=%s",$id);
        if($array = dbCon::get_fetch_array($query)){
            $this->id = $id;
            $this->title = dbCon::removeslash($array['title']);
            $this->description = dbCon::removeslash($array['description']);
            $this->name = dbCon::removeslash($array['name']);
            $this->description = dbCon::removeslash($array['description']);
            $this->duration = dbCon::removeslash($array['duration']);
            $this->type = dbCon::removeslash($array['type']);
            $this->show_home = dbCon::removeslash($array['show_home']);
            $this->added_date = dbCon::removeslash($array['added_date']);
            $this->status = dbCon::removeslash($array['status']);
        }
    }

    //set methods
    public function setId($value){$this->id = $value;}
    public function setTitle($value){$this->title = $value;}
    public function setName($value){$this->name = $value;}
    public function setDescription($value){$this->description = $value;}
    public function setDuration($value){$this->duration = $value;}
    public function setType($value){$this->type = $value;}
    public function setShow_home($value){$this->show_home = $value;}
    public function setAdded_date($value){$this->added_date = $value;}
    public function setStatus($value){$this->status = $value;}

    //get methods
    public function getId(){return $this->id;}
    public function getTitle(){return $this->title;}
    public function getName(){return $this->name;}
    public function getDescription(){return $this->description;}
    public function getDuration(){return $this->duration;}
    public function getType(){return $this->type;}
    public function getShow_home(){return $this->show_home;}
    public function getAdded_date(){return $this->added_date;}
    public function getStatus(){return $this->status;}

    //add the record
    public function save(){

        $query = sprintf("INSERT INTO videos (id,title,name,description,duration,type,show_home,added_date,status) values ('%s','%s','%s','%s','%s','%s','%s',NOW(),'%s')",
            $this->getId(),
            $this->getTitle(),
            $this->getName(),
            $this->getDescription(),
            $this->getDuration(),
            $this->getType(),
            $this->getShow_home(),
            $this->getAdded_date(),
            $this->getStatus());

        if($result = dbCon::execute_query($query)){
            return true;
        }
        else return false;

    }

    //update the record
    public function update()
    {
        $query = sprintf("UPDATE videos SET status='%s' WHERE id='%s'",
            $this -> getStatus(),
            $this -> getId());
        if($result = dbCon::execute_query($query)){
            return true;
        }
        else return false;
    }

    //Upload File
    public function uploadFile($post_field, $paramFile)
    {
        $target = "uploadVideo/".$paramFile;
        move_uploaded_file($_FILES[$post_field]['tmp_name'], $target);
    }

    //get records
    public function getRecords(){
        $query = sprintf("SELECT * FROM videos");
        if($result = dbCon::execute_query($query)){
            return $result;
        }
        else return false;
    }

    //delete the record
    public function delete(){

        $query = sprintf("DELETE FROM videos WHERE id='%s'",$this->getId());
        if($result = dbCon::execute_query($query)){
            return true;
        }
        else return false;
    }

}
?>
