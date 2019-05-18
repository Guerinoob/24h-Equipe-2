<?php
include('../settings.php');

global $db;

$req = 'SELECT * FROM users WHERE username = ?';
$db->prepare($req);


$test = 'test';
var_dump($db->execute_prepared_query(array($test)));

