<?php
class Group{

    public $name;
    private $DB;

    function __construct($DB, $name='') {
        $this->name = $name;
        $this->DB = $DB;
    }


    function save(){

        $stmt = $this->DB->prepare("SELECT name FROM `group` WHERE name = ?");
        $stmt->execute(array($this->name));

        if($stmt->rowCount() != 1){
            $stmt = $this->DB->prepare("INSERT INTO `group`(`name`) VALUES (?)");
            $stmt->execute(array($this->name));
            return true;
        }
        return false;
    }

    function delete($name){

        $stmt = $this->DB->prepare("DELETE FROM `group` WHERE name = ?");
        $stmt->execute(array($name));
    }

    function isGroup($DB, $name){

        $stmt = $DB->prepare("SELECT name FROM `group` WHERE name = ?");
        $stmt->execute(array($name));

        if($stmt->rowCount() == 1){
            return true;
        }
        return false;
    }

    function getAll(){

        $stmt = $this->DB->prepare("SELECT name FROM `group`");
        $stmt->execute();
        //retourne un tableau à 2 dimensions ?
        $result = $stmt->fetchAll();
        return $result;
    }
}

 ?>
