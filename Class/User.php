<?php
class User{

    private $id;
    public $email;
    public $last_name;
    public $first_name;
    public $anniv;
    public $group;
    private $DB;

    function __construct($DB, $email ='', $last_name='', $first_name='', $anniv='', $group='') {
        $this->email = $email;
        $this->last_name = $last_name;
        $this->first_name = $first_name;
        $this->anniv = $anniv;
        $this->group = $group;
        $this->DB = $DB;

        $this->id = $this->getID($email);
    }

    function getID($email){
        $stmt = $this->DB->prepare("SELECT id FROM `users` WHERE email = ?");
        $stmt->execute(array($email));

        return $stmt->fetch()[0];
    }

    function save(){

        $stmt = $this->DB->prepare("SELECT name FROM `group` WHERE name = ?");
        $stmt->execute(array($this->group));
        //le groupe doit exister
        if($stmt->rowCount() != 1){
            echo 'group';
            return false;
        }

        $stmt = $this->DB->prepare("SELECT email FROM `users` WHERE email = ?");
        $stmt->execute(array($this->email));
        //l'email doit être unique
        if($stmt->rowCount() == 1){
            echo 'mail';
            return false;
        }
        $stmt = $this->DB->prepare("INSERT INTO `users`(`email`, `last_name`, `first_name`, `date_anniversary`, `group_name`) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute(array($this->email, $this->last_name, $this->first_name, $this->anniv, $this->group));
        return true;
    }

    function delete($id){
        $stmt = $this->DB->prepare("DELETE FROM `users` WHERE id = ?");
        $stmt->execute(array($id));
    }

    function update(){

        $stmt = $this->DB->prepare("UPDATE `users` SET email = ?, last_name = ?, first_name = ?, date_anniversary = ?, group_name = ? WHERE id = ?");
        $stmt->execute(array($this->email, $this->last_name, $this->first_name, $this->anniv, $this->group, $this->id));
    }

    function getAll(){
        $stmt = $this->DB->prepare("SELECT * FROM `users` ORDER BY last_name");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    function getUsers($search){
        $stmt = $this->DB->prepare("SELECT * FROM `users` WHERE last_name = ? OR group_name = ?");
        $stmt->execute(array($search, $search));

        if($stmt->rowCount() == 1){
            return $stmt->fetchAll();
        }
    }

}







 ?>
