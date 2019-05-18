<?php


class User
{

    public $ID = -1;

    public $attr = array();

    public function __construct($username = ''){

    }

    public function init($username, $password){
        if(empty($username) || empty($password)){
            return false;
        }

        global $db;

        $req = "SELECT * FROM users WHERE username = ? AND password = ?";
        $db->prepare($req);
        $row = $db->execute_prepared_query(array('test', 'test'))[0];

        if(!$row){
            return false;
        }

        $this->ID = $row['id'];


        unset($row['id']);

        foreach($row as $key=>$value){
            $this->attr[$key] = $value;
        }

        $_SESSION['user'] = $this;

        return true;
    }

    public function get($key){
        if(mb_strtolower($key) == 'id')
            return $this->ID;

        if(isset($this->attr[$key])){
            return $this->attr[$key];
        }
        else{

        }

    }

    public function set($key, $value){
        if(mb_strtolower($key) == 'id'){
            return false;
        }

        $this->attr[$key] = $value;
        return true;
    }

}

