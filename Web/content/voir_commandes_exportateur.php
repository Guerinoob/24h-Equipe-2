<?php
include('../includes/utils_page.php');
get_header();

$user = get_logged_user();

if($user){
    if(is_exportateur($user->get('id'))){

        global $db;

        if($_POST['submit']){
            $nouvel_etat = $_POST['etat'];
            $commande = $_POST['commande'];

            $req = "UPDATE commandes SET etat = ? WHERE id = ?";
            $args = array($nouvel_etat, $commande);

            $db->prepare($req);

            if($db->execute_prepared_query($args)){
                echo 'Commande mise à jour !';

                if($nouvel_etat == 5){
                    $req = "SELECT * FROM commandes WHERE id = ?";
                    $args = array($commande);

                    $db->prepare($req);
                    $ligne = $db->execute_prepared_query($req)[0];

                    $quantite = $ligne['quantite'];
                    $type_cafe = $ligne['id_type_cafe'];
                    $exportateur = $ligne['exportateur'];
                    $pays = $ligne['id_pays'];

                    $req = "UPDATE varietes SET stock = stock - ? WHERE id_exportateur = ? AND id_type_cafe = ? AND id_pays = ?";
                    $args = array($quantite, $exportateur, $type_cafe, $pays);

                    $db->prepare($req);
                    $db->execute_prepared_query($args);
                }
            } else{
                echo 'Erreur lors de la mise à jour !';
            }
        }

        $req = "SELECT commandes.*, type_cafe.nom as nom_cafe, pays.nom as nom_pays, username as nom_importateur, etats_commandes.nom as etat, etats_commandes.id as etat_id FROM commandes 
                JOIN users ON commandes.id_importateur = users.id 
                JOIN type_cafe ON type_cafe.id = commandes.id_type_cafe 
                JOIN pays ON pays.id = commandes.id_pays 
                JOIN etats_commandes ON etats_commandes.id = commandes.etat 
                WHERE id_exportateur = ?";
        $args = array($user->get('id'));

        $req_etats = "SELECT * FROM etats_commandes";
        $etats = $db->query_get_rows($req_etats);


        $db->prepare($req);
        $commandes = $db->execute_prepared_query($args);




        ?>

        <h1 class="title has-text-dark has-text-weight-bold" style="text-align:center; margin-bottom:2%;margin-top:2%;">Visualiser vos commandes</h1>

        <table class="table is-bordered is-striped is-narrow" style="margin: auto; margin-bottom : 2%;">
            <thead>
                <th>Type de café</th>
                <th>Provenance</th>
                <th>Client</th>
                <th>État de la commande</th>
                <th>Mettre à jour</th>
            </thead>

            <tbody>

                <?php



                foreach($commandes as $commande){
                    echo '<tr>';
                        echo '<td>'.$commande['nom_cafe'].'</td>';
                        echo '<td>'.$commande['nom_pays'].'</td>';
                        echo '<td>'.$commande['nom_importateur'].'</td>';
                        echo '<td>'.$commande['etat'].'</td>';

                        echo '<td>';
                            echo '<form method="POST" action="">';
                                echo '<input type="text" id="commande" name="commande" value="'.$commande['id'].'" hidden />';

                                echo '<div class="select" style="margin-right:1px; "><select name="etat" id="etat">';
                                    foreach($etats as $etat){
                                        echo '<option value="'.$etat['id'].'" '.($commande['etat_id'] == $etat['id'] ? "selected" : " " ).'>'.$etat['nom'].'</option>';
                                    }
                                echo '</select> </div>';

                                echo '<input class="button is-dark" type="submit" id="submit" name="submit" value="Mettre à jour" />';
                            echo '</form>';
                        echo '</td>';
                    echo '</tr>';
                }

                ?>

            </tbody>
        </table>

        <?php


    }
}


get_footer();