<?php

include_once('../settings.php');

function authenticate_user_by_username($username, $password){

    if(empty($username) || empty($password)){
        return false;
    }

    $user = new User();
   if($user->init_by_username($username, $password)){
       $_SESSION['user'] = $user;
       return true;
   }

   return false;

}


function authenticate_user_by_email($email, $password){
    if(empty($email) || empty($password)){
        return false;
    }

    $user = new User();
    if($user->init_by_email($email, $password)){
        $_SESSION['user'] = $user;
        return true;
    }

    return false;
}


function get_logged_user(){
    if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];

        if(!$user) return null;

        return $user;
    }

    return null;
}


function disconnect_current_user(){
    if($user = get_logged_user()){
        unset($_SESSION['user']);
    }
}