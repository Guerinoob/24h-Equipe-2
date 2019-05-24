<?php
include('../includes/utils_page.php');
get_header();

$req = "SELECT * FROM pays ORDER BY (production_arabica + production_robusta) DESC";

global $db;

$results = array();

if(!($results = $db->query_get_rows($req))){
    echo 'Erreur lors de la récupération';
}
else {

    $prod_totale = 0;

    foreach($results as $pays){
        $prod_totale += $pays['production_arabica'] + $pays['production_robusta'];
    }


    echo '<h1 class="title has-text-info has-text-weight-bold">Visualiser les 20 plus gros producteurs</h1>';

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
            $classement = 1;

            foreach($results as $pays){

                $production = $pays['production_arabica']+$pays['production_robusta'];

                if($classement > 20) break;

                echo '<tr>';

                    echo '<td>'.$classement.'</td>';
                    echo '<td><img src="image/'.$pays['drapeau'].'" width="30px" height="30px" /> '.$pays['nom'].'</td>';
                    echo '<td>'.$pays['description'].'</td>';
                    echo '<td>'.$pays['capitale'].'</td>';
                    echo '<td>'.$pays['nb_habitants'].'</td>';
                    echo '<td>'.$pays['surface'].'</td>';
                    echo '<td colspan="2">'.$production.'</td>';
                    echo '<td colspan="2">'.(($production/$prod_totale) * 100).'%</td>';

                echo '</tr>';
                $classement++;
            }

        echo '</tbody>';


    echo '</table>';


}
get_footer();
?>
