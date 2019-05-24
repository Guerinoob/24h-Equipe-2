<?php
include('../includes/utils_page.php');
get_header();

$user = get_logged_user();

if($user){
    if(is_importateur($user->get('id'))){

        global $db;


        $req = "SELECT commandes.*, type_cafe.nom as nom_cafe, pays.nom as nom_pays, username as nom_exportateur, etats_commandes.nom as etat, etats_commandes.id as etat_id FROM commandes 
                JOIN users ON commandes.id_exportateur = users.id 
                JOIN etats_commandes ON etats_commandes.id = commandes.etat 
                JOIN type_cafe ON type_cafe.id = commandes.id_type_cafe 
                JOIN pays ON pays.id = commandes.id_pays 
                WHERE id_importateur = ?";
        $args = array($user->get('id'));



        $db->prepare($req);
        $commandes = $db->execute_prepared_query($args);




        ?>

        <h1>Visualiser vos commandes</h1>

        <table>
            <thead>
            <th>Type de café</th>
            <th>Provenance</th>
            <th>Exportateur</th>
            <th>État de la commande</th>
            </thead>

            <tbody>

            <?php



            foreach($commandes as $commande){
                echo '<tr>';
                echo '<td>'.$commande['nom_cafe'].'</td>';
                echo '<td>'.$commande['nom_pays'].'</td>';
                echo '<td>'.$commande['nom_exportateur'].'</td>';
                echo '<td>'.$commande['etat'].'</td>';
                echo '</tr>';
            }

            ?>

            </tbody>
        </table>

        <?php


    }
}


get_footer();