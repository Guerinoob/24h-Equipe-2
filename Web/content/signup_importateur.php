<?php
include('../includes/utils_page.php');
get_header();


if(isset($_POST['submit'])){
    $non_remplis = array();

    foreach($_POST as $key=>$value){
        if(empty($value))
            $non_remplis[] = $key;
    }

    if(count($non_remplis) > 0){
        echo 'Veuillez remplir ces champs : <br />';

        foreach($non_remplis as $non_rempli){
            echo $non_rempli.'<br />';
        }
    }
    else{
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = 'importateur';

        $metas = array();

        $metas['entreprise'] = $_POST['entreprise'];
        $metas['adresse'] = $_POST['adresse'];
        $metas['code_postal'] = $_POST['code_postal'];
        $metas['ville'] = $_POST['ville'];
        $metas['pays'] = $_POST['pays'];
        $metas['telephone'] = $_POST['telephone'];

        $user_id = insert_user($username, $password, $role);

        if(!$user_id){
            echo 'Erreur';
        }
        else{
            global $users;

            foreach($metas as $key=>$value){
                if(!$users->add_meta($user_id, $key, $value)){
                    echo $key;
                }
            }
            echo $username.', (ID = '.$user_id.'), vous êtes bien inscrit !';
        }
    }
}


?>

    <form method="POST" action="">
        <fieldset>
            <legend>Inscription importateur</legend>

            <label for="username">Username </label><input type="text" id="username" name="username" value="<?php if(isset($_POST['username'])) echo $_POST['username']; ?>" />

            <label for="password">Mot de passe </label><input type="password" name="password" id="password" />


            <label for="entreprise">Nom d'entreprise : </label><input type="text" name="entreprise" id="entreprise" value="<?php if(isset($_POST['entreprise'])) echo $_POST['entreprise']; ?>" />

            <label for="adresse">Adresse : </label><input type="text" name="adresse" id="adresse" value="<?php if(isset($_POST['adresse'])) echo $_POST['adresse']; ?>" />

            <label for="code_postal">Code Postal : </label><input type="text" name="code_postal" id="code_postal" value="<?php if(isset($_POST['code_postal'])) echo $_POST['code_postal']; ?>" />

            <label for="ville">Ville : </label><input type="text" name="ville" id="ville" value="<?php if(isset($_POST['ville'])) echo $_POST['ville']; ?>" />

            <label for="pays">Pays : </label><input type="text" name="pays" id="pays" value="<?php if(isset($_POST['pays'])) echo $_POST['pays']; ?>" />

            <label for="telephone">Téléphone : </label><input type="text" name="telephone" id="telephone" value="<?php if(isset($_POST['telephone'])) echo $_POST['telephone']; ?>" />



            <input type="submit" name="submit" id="submit" value="S'inscrire" />
        </fieldset>
    </form>


<?php


get_footer();