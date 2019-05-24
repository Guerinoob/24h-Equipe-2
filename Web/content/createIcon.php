<?php
include_once('../includes/utils_page.php');
get_header();
if (isset($_GET["pays"])) {
    global $db;
    $results = $db->prepare("SELECT nom,production_arabica,production_robusta from pays where id = ?");
    if ($results) {
        $array = array($_GET['pays']);
        $results = $db->execute_prepared_query($array);
        if ($results) {
            echo '<div id="pays">' . $results[0]["nom"] . '</div>';
            echo '<div id="production_arabica">' . $results[0]["production_arabica"] . '</div>';
            echo '<div id="production_robusta">' . $results[0]["production_robusta"] . '</div>';
        }
    }

}
?>

<canvas id="pie-chart"></canvas>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="js/html2canvas.js"></script>
<script src="js/createIcon.js"></script>
