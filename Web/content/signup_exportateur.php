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
        $role = 'exportateur';

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

    <section class="hero has-background-grey-darker is-fullheight">
        <div class="hero-body has-text-centered">
            <div class="container">
                <div class="column is-6 is-offset-3">
                    <div class="box" style="border-radius: 20px;">
                        <h1 class="title has-text-info has-text-weight-bold">S'ENREGISTRER</h1>
                        <div class="stroke-line is-center"></div>
                        <form action="" method="POST">
                            <div class="field">
                                <div class="control has-icons-left">
                                    <label>
                                        <input type="text" placeholder="Nom d'utilisateur" class="input" id="username" name="username" value="<?php if(isset($_POST['username'])) echo $_POST['username']; ?>" />
                                        <span class="icon is-small is-left">
                                                <i class="fas fa-user"></i>
                                            </span>
                                    </label>
                                </div>
                            </div>

                            <div class="field">
                                <div class="control has-icons-left">
                                    <label>
                                        <input placeholder="Mot de passe" type="password" class="input" name="password" id="password" />
                                        <span class="icon is-small is-left">
                                                <i class="fas fa-lock"></i>
                                            </span>
                                    </label>
                                </div>
                            </div>

                            <div class="field">
                                <div class="control has-icons-left">
                                    <label>
                                        <input placeholder="Nom de l'entreprise" type="text" class="input" name="entreprise" id="entreprise" value="<?php if(isset($_POST['entreprise'])) echo $_POST['entreprise']; ?>" />
                                        <span class="icon is-small is-left">
                                                <i class="fas fa-user"></i>
                                            </span>
                                    </label>
                                </div>
                            </div>
                            <div class="field">
                                <div class="control has-icons-left">
                                    <label>
                                        <input placeholder="Adresse postale" type="text" class="input" name="adresse" id="adresse" value="<?php if(isset($_POST['adresse'])) echo $_POST['adresse']; ?>" />
                                        <div class="icon is-small is-left">
                                            <i class="fas fa-home"></i>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="field">
                                <div class="control has-icons-left">
                                    <label>
                                        <input placeholder="Pays" type="text" name="pays" class="input" id="pays" value="<?php if(isset($_POST['pays'])) echo $_POST['pays']; ?>" />
                                        <div class="icon is-small is-left">
                                            <i class="fas fa-globe"></i>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="localisation">
                                <div class="field">
                                    <div class="control has-icons-left">
                                        <label>
                                            <input placeholder="Ville" type="text" name="ville" class="input" id="ville" value="<?php if(isset($_POST['ville'])) echo $_POST['ville']; ?>" />
                                            <div class="icon is-small is-left">
                                                <i class="fas fa-home"></i>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="control has-icons-left">
                                        <label>
                                            <input placeholder="Code postal" type="text" name="code_postal" class="input" id="code_postal" value="<?php if(isset($_POST['code_postal'])) echo $_POST['code_postal']; ?>" />
                                            <div class="icon is-small is-left">
                                                <i class="fas fa-location-arrow"></i>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="field is-horizontal">
                                <div class="field-body">
                                    <div class="field is-expanded">
                                        <div class="field has-addons">
                                            <p class="control">
                                                <a class="button is-static">
                                                    +33
                                                </a>
                                            </p>
                                            <p class="control is-expanded">
                                                <input placeholder="Numero de telephone" type="text" class="input" name="telephone" id="telephone" value="<?php if(isset($_POST['telephone'])) echo $_POST['telephone']; ?>" />
                                            </p>
                                        </div>
                                        <p class="help">N'entrez pas le premier zéro</p>
                                    </div>
                                </div>
                            </div>

                            <button class="button is-block is-info is-fullwidth has-text-weight-medium">Créer le compte</button>
                            <a href="#Register" class="is-link has-text-grey-light" >Déjà un compte ? Se connecter.</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>







<?php


get_footer();

?>