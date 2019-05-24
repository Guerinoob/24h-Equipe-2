<?php
include('../includes/utils_page.php');
get_header();

$user = get_logged_user();

if($user){
    if(is_exportateur($user->get('id'))){

        global $db;

        if(isset($_POST['submit'])){
            $pays = $_POST['pays'];
            $type_cafe = $_POST['type_cafe'];
            $stock = $_POST['stock'];



            $req_insert = "INSERT INTO varietes(id_type_cafe, id_pays, stock, id_exportateur) VALUES(?, ?, ?, ?)";
            $args = array($type_cafe, $pays, $stock, $user->get('id'));

            if($db->prepare($req_insert)){
                if($db->execute_prepared_query($args)){
                    echo 'La variété a été ajoutée !';
                }
                else{
                    echo 'Erreur execute';
                }
            }
            else{
                echo 'Erreur prepare';
            }


        }


        $req_types = "SELECT * FROM type_cafe";
        $req_pays = "SELECT id, nom FROM pays";

        $types = $db->query_get_rows($req_types);
        $liste_pays = $db->query_get_rows($req_pays);

        ?>

        <form method="POST" action="">
            <fieldset>

                <legend>Ajouter une variété</legend>

                <label for="type_cafe">Type de café : </label>
                <select name="type_cafe" id="type_cafe">
                    <?php

                    foreach($types as $type){
                        echo '<option value="'.$type['id'].'">'.$type['nom'].'</option>';
                    }

                    ?>
                </select>


                <label for="pays">Provenance : </label>
                <select name="pays" id="pays">
                    <?php

                    foreach($liste_pays as $pays){
                        echo '<option value="'.$pays['id'].'">'.$pays['nom'].'</option>';
                    }

                    ?>
                </select>

                <label for="stock">Stock actuel : </label><input type="number" name="stock" id="stock" value="0" />



                <input type="submit" name="submit" id="submit" value="Ajouter" />

            </fieldset>


        </form>

        <?php

    }
}


get_footer();