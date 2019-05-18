<?php

include_once('settings.php');

function authenticate_user_by_username($username, $password){

    if(empty($username) || empty($password)){
        return false;
    }

    $user = new User();
    return $user->init('test', 'test');

}

function get_logged_user(){
    if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];

        if(!$user) return false;

        return $user;
    }

    return false;
}