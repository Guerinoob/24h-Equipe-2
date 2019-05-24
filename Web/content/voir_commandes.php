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
            } else{
                echo 'Erreur lors de la mise à jour !';
            }
        }

        $req = "SELECT commandes.*, username as nom_importateur, etats_commandes.nom as etat, etats_commandes.id as etat_id FROM commandes 
                JOIN users ON commandes.id_importateur = users.id 
                JOIN etats_commandes ON etats_commandes.id = commandes.etat 
                WHERE id_exportateur = ?";
        $args = array($user->get('id'));

        $req_etats = "SELECT * FROM etats_commandes";
        $etats = $db->query_get_rows($req_etats);


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
                <th>Mettre à jour</th>
            </thead>

            <tbody>

                <?php



                foreach($commandes as $commande){
                    echo '<tr>';
                        echo '<td>'.$commande['id_type_cafe'].'</td>';
                        echo '<td>'.$commande['id_pays'].'</td>';
                        echo '<td>'.$commande['nom_importateur'].'</td>';
                        echo '<td>'.$commande['etat'].'</td>';

                        echo '<td>';
                            echo '<form method="POST" action="">';
                                echo '<input type="text" id="commande" name="commande" value="'.$commande['id'].'" hidden />';

                                echo '<select name="etat" id="etat">';
                                    foreach($etats as $etat){
                                        echo '<option value="'.$etat['id'].'" '.($commande['etat_id'] == $etat['id'] ? "selected" : " " ).'>'.$etat['nom'].'</option>';
                                    }
                                echo '</select>';

                                echo '<input type="submit" id="submit" name="submit" value="Mettre à jour" />';
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