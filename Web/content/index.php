<?php
include('../settings.php');

global $db;

$req = "SELECT * FROM users";
echo $db->query($req).'<br />';

var_dump($db->query);

