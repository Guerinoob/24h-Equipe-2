<?php
include_once('../settings.php');

global $db;
$results = $db->query_get_rows("SELECT drapeau,nom,production_arabica,production_robusta from pays ");
echo json_encode($results);
?>