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

    $user = get_logged_user();


    echo '<h1 class="title has-text-dark has-text-weight-bold" style="text-align:center; margin-bottom:2%;margin-top:2%;">Visualiser les 20 plus gros producteurs</h1>';

    echo '<table class="table is-bordered is-striped is-narrow " style="margin: auto; margin-bottom: 2%; ">';
        echo '<thead class="thead">';
            echo '<th class="th"></th>';
            echo '<th class="th">Pays</th>';
            echo '<th class="th">Description</th>';
            echo '<th class="th">Capitale</th>';
            echo '<th class="th">Nombre d\'habitants</th>';
            echo '<th class="th">Surface du pays</th>';
            echo '<th class="th" colspan="2">Production en 2013</th>';
            echo '<th class="th" colspan="2">Pourcentage de production</th>';
        echo '</thead>';

        echo '<tbody class="tbody">';
            $classement = 1;

            foreach($results as $pays){

                $production = $pays['production_arabica']+$pays['production_robusta'];

                if($classement > 20) break;

                echo '<tr class="tr">';

                    echo '<td class="th">'.$classement.'</td>';
                    echo '<td class="th"><img src="images/'.$pays['drapeau'].'" width="30px" height="30px" /> '.$pays['nom'].'</td>';
                    echo '<td class="th">'.$pays['description'].'</td>';
                    echo '<td class="th">'.$pays['capitale'].'</td>';
                    echo '<td class="th">'.$pays['nb_habitants'].'</td>';
                    echo '<td class="th">'.$pays['surface'].'</td>';
                    echo '<td class="th" colspan="2">'.$production.'</td>';
                    echo '<td class="th" colspan="2">'.(($production/$prod_totale) * 100).'%</td>';

                echo '</tr>';
                $classement++;
            }

        echo '</tbody>';


    echo '</table>';


}
get_footer();
?>

<script language="JavaScript" type="text/javascript">
    function ajouterPays()
    {
        document.location="ajoutPays.php";
    }
    function modifierPays()
    {
        document.location="modifierPays.php";
    }
</script>
