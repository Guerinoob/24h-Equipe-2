<?php
include_once('../settings.php');

$pays = $_POST['pays'];
$type_cafe = $_POST['type_cafe'];
$exportateur = $_POST['exportateur'];

$req = "SELECT * FROM varietes WHERE id_pays = ? AND id_type_cafe = ? AND id_exportateur = ?";
$args = array($pays, $type_cafe, $exportateur);

global $db;

if($db->prepare($req)){
    $results = $db->execute_prepared_query($args)[0];

    if($results){

        echo '(quantité restante : '.$results['stock'].' kg)';

    } else{
        echo 'Erreur execute';
    }
} else{
    echo 'Erreur prepare';
}