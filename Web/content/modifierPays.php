<?php
    include_once('../includes/utils_page.php');
    get_header();

    global $db;

    $tabPays = $db->query_get_rows("select id,nom from pays");

?>

<select id="pays">
    <option value="0">-- Selectionner un pays --</option>
    <?php
    foreach($tabPays as $pays)
    {
        echo "<option value='".$pays['id']."'>".$pays['nom']."</option>";
    }
    ?>
</select>

<div id="la">

</div>

<script language="JavaScript" type="text/javascript">
    var pays = document.getElementById('pays');

    var chargeDonneesPays = function()
    {
        $.post(
            'recupInfoPays.php',
            {
                'id': pays.value
            },
            function(response){
                var la = document.getElementById('la');
                la.innerHTML = response;
            }
        )
    }

    pays.addEventListener('change', chargeDonneesPays, false);
</script>