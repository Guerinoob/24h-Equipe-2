<?php
include_once('../includes/utils_page.php');
get_header();


if(isset($_POST['submit'])){
    $non_remplis = array();

    foreach($_POST as $key=>$value){
        if(empty($value))
            $non_remplis[] = $key;
    }

    if(count($non_remplis) > 0){

    }
    else{
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user_id = insert_user($username, $email, $password);

        if(!$user_id){
            echo 'Erreur';
        }
        else{
            echo $username.', (ID = '.$user_id.'), vous êtes bien inscrit !';
        }
    }
}


?>

<form method="POST" action="">
    <fieldset>
        <legend>Incrisption</legend>

        <label for="email">Email </label><input type="email" name="email" id="email" />

        <label for="username">Username </label><input type="text" id="username" name="username" />

        <label for="password">Mot de passe </label><input type="password" name="password" id="password" />

        <input type="submit" name="submit" id="submit" value="S'inscrire" />
    </fieldset>
</form>


<?php


get_footer();

