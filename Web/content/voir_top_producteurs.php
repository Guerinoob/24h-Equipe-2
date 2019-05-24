<?php
include('../includes/utils_page.php');
get_header();

$req = "SELECT * FROM pays ORDER BY (production_arabica + production_robusta) DESC";

global $db;

if(!($results = $db->query($req))){
    echo 'Erreur lors de la récupération';
}
else {


    echo '<h1>Visualiser les 20 plus gros producteurs</h1>';

    echo '<table>';
        echo '<thead>';
            echo '<th></th>';
            echo '<th>Pays</th>';
            echo '<th>Description</th>';
            echo '<th>Capitale</th>';
            echo '<th>Nombre d\'habitants</th>';
            echo '<th>Surface du pays</th>';
            echo '<th colspan="2">Production en 2013</th>';
        echo '</thead>';

        echo '<tbody>';

        echo '</tbody>';


    echo '</table>';


}
get_footer();