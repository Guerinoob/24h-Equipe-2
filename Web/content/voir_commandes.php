<?php
include('../includes/utils_page.php');
get_header();

$user = get_logged_user();

if($user){
    if(is_exportateur($user->get('id'))){

        $req = "SELECT commandes.*, username as nom_importateur, etats_commandes.nom as etat FROM commandes 
                JOIN users ON commandes.id_importateur = users.id 
                JOIN etats_commandes ON etats_commandes.id = commandes.etat 
                WHERE id_exportateur = ?";
        $args = array($user->get('id'));

        global $db;

        $db->prepare($req);
        $commandes = $db->execute_prepared_query($args);

        ?>

        <h1>Visualiser vos commandes</h1>

        <table>
            <thead>
                <th>Type de café</th>
                <th>Provenance</th>
                <th>Client</th>
                <th>État de la commande</th>
            </thead>

            <tbody>

                <?php



                foreach($commandes as $commande){
                    echo '<tr>';
                        echo '<td>'.$commande['id_type_cafe'].'</td>';
                        echo '<td>'.$commande['id_pays'].'</td>';
                        echo '<td>'.$commande['nom_importateur'].'</td>';
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