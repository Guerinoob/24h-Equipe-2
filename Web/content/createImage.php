<?php
if(isset($_POST["img"]) && isset($_POST["pays"])){
    $data = explode(',', $_POST["img"]);
    $content = base64_decode($data[1]);
    $file = fopen("img/graph_".$_POST["pays"].".png", "wb");
    fwrite($file, $content);
    fclose($file);

}
?>