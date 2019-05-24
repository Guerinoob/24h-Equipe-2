<?php
include_once('../settings.php');
$pays = $_POST['pays'];
$type_cafe = $_POST['type_cafe'];

$req = "SELECT id, username FROM users WHERE id IN(
            SELECT id_exportateur FROM varietes WHERE id_pays = ? AND id_type_cafe = ?
        )";
$args = array($pays, $type_cafe);

global $db;

if($db->prepare($req)){
    $results = $db->execute_prepared_query($args);
    if($results){

        echo '<option value="-1">Choisir un exportateur...</option>';

        foreach($results as $result){
            echo '<option value="'.$result['id'].'">'.$result['username'].'</option>';
        }

    } else{
        echo 'Erreur execute';
    }
} else{
    echo 'Erreur prepare';
}