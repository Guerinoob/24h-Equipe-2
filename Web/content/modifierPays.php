<?php
    include_once('../includes/utils_page.php');
    get_header();

    global $db;

    $tabPays = $db->query_get_rows("select id,nom from pays");

    $json  = file_get_contents("js/traduction.json");
    $configData = json_decode($json, true);

    function str_to_noaccent($str)
    {
        $url = $str;
        $url = preg_replace('#Ç#', 'C', $url);
        $url = preg_replace('#ç#', 'c', $url);
        $url = preg_replace('#è|é|ê|ë#', 'e', $url);
        $url = preg_replace('#È|É|Ê|Ë#', 'E', $url);
        $url = preg_replace('#à|á|â|ã|ä|å#', 'a', $url);
        $url = preg_replace('#@|À|Á|Â|Ã|Ä|Å#', 'A', $url);
        $url = preg_replace('#ì|í|î|ï#', 'i', $url);
        $url = preg_replace('#Ì|Í|Î|Ï#', 'I', $url);
        $url = preg_replace('#ð|ò|ó|ô|õ|ö#', 'o', $url);
        $url = preg_replace('#Ò|Ó|Ô|Õ|Ö#', 'O', $url);
        $url = preg_replace('#ù|ú|û|ü#', 'u', $url);
        $url = preg_replace('#Ù|Ú|Û|Ü#', 'U', $url);
        $url = preg_replace('#ý|ÿ#', 'y', $url);
        $url = preg_replace('#Ý#', 'Y', $url);

        return ($url);
    }

    function erreur2($message)
    {
        echo '<script language="JavaScript" type="text/javascript">';
        echo "alert('".$message."');";
        echo 'document.location="voir_top_producteurs.php";';
        echo "</script>";
    }

    function erreur($message)
    {
        echo '<script language="JavaScript" type="text/javascript">';
        echo "alert('".$message."');";
        echo 'document.location="modifierPays.php";';
        echo "</script>";
        die();
    }

    if(isset($_POST["enregistrer"]))
    {
        if(!isset($_POST["pays"]) || empty($_POST["pays"]))
        {
            erreur('Pas de pays');
        }
        if(!isset($_POST["description"]) || empty($_POST["description"]))
        {
            erreur('Pas de description');
        }
        if(!isset($_POST["capitale"]) || empty($_POST["capitale"]))
        {
            erreur('Pas de capitale');
        }
        if(!isset($_POST["nbhabitants"]) || empty($_POST["nbhabitants"]))
        {
            erreur('Pas de nbhabitants');
        }
        if(!isset($_POST["surface"]) || empty($_POST["surface"]))
        {
            erreur('Pas de surface');
        }
        if(!isset($_POST["quantiteArabica"]) || empty($_POST["quantiteArabica"]))
        {
            erreur('Pas de quantite pour arabica');
        }
        if(!isset($_POST["quantiteRobusta"]) || empty($_POST["quantiteRobusta"]))
        {
            erreur('Pas de quantite pour robusta');
        }


        ////ATTRIBUTION DES VARIOABLE EN ENLVANT LES ACCENTS
        $id = $_POST['id'];
        $paysASave = str_to_noaccent($_POST["pays"]);
        $descriptionASave = str_to_noaccent($_POST["description"]);
        ////RECUPERATION EXTENSION
        if ($_FILES['drapeau']['error'] <= 0)
        {
            $tabExt = explode('.',$_FILES['drapeau']['name']);
            $drapeauASave = str_to_noaccent(mb_strtolower($paysASave).".".$tabExt[1]);
        }
        else
        {
            $db->prepare("select drapeau from pays where id = ?");
            $tableau = array($id);
            $resTableauu = $db->execute_prepared_query($tableau);
            $drapeauASave = $resTableauu[0]['drapeau'];
        }
        $capitaleASave = str_to_noaccent($_POST["capitale"]);
        $nbhabitantsASave = str_to_noaccent($_POST["nbhabitants"]);
        $surfaceASave = str_to_noaccent($_POST["surface"]);
        $quantiteArabicaASave = str_to_noaccent($_POST["quantiteArabica"]);
        $quantiteRobustaASave = str_to_noaccent($_POST["quantiteRobusta"]);

        $verif = 0;
        foreach($configData as $value)
        {
            if(mb_strtoupper($value) == mb_strtoupper($paysASave))
            {
                $verif = 1;
            }
        }
        if($verif == 0)
        {
            erreur('Pays pas correspondant');
        }

        ////MAJ PAYS
        $db->prepare("update pays 
                            set nom = ?,
                            description = ?,
                            drapeau = ?,
                            capitale = ?,
                            nb_habitants = ?,
                            surface = ?,
                            production_arabica = ?,
                            production_robusta = ?
                            where id = ?");
        $tableauAInserer = array($paysASave,$descriptionASave,$drapeauASave,$capitaleASave,$nbhabitantsASave,$surfaceASave,$quantiteArabicaASave,$quantiteRobustaASave,$id);
        $bool = $db->execute_prepared_query($tableauAInserer);

        ////COPIE DU DRAPEAU DANS LE DOSSIER IMAGE
        $resultat = move_uploaded_file($_FILES['drapeau']['tmp_name'],"image/".$drapeauASave);

        erreur2('Pays bien modifié');

        /*$results = $db->prepare("SELECT id from pays where nom = ?");
        if($results) {
            $array = array($paysASave);
            $results = $db->execute_prepared_query($array);
            if ($results) {
                $ch = curl_init();
                $dir = preg_replace('/ajoutPays.php/', '', $_SERVER["PHP_SELF"], 1);
                $path = $_SERVER["REQUEST_SCHEME"]."://".$_SERVER["SERVER_NAME"].$dir;
                curl_setopt($ch, CURLOPT_URL, $path."createIcon?pays=".$results[0]["id"].".php");
                curl_setopt($ch, CURLOPT_HEADER, 1);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_exec($ch);
                curl_close($ch);
            }
        }*/

    }

?>



<form action="modifierPays.php" method="post" enctype="multipart/form-data" id="formAfficherModif">
    <input type="hidden" name="idPays" id="idPays">
</form>

<div class="field column is-4 is-offset-4 is-fullwidth">
    <div class="control">
        <div class="select is-warning">
            <select id="pays" class="is-fullwidth">
                <option value="0">-- Selectionner un pays --</option>
                <?php
                foreach($tabPays as $pays)
                {
                    if(isset($_POST['idPays']))
                    {
                        if($pays['id'] == $_POST['idPays'])
                        {
                            echo "<option value='".$pays['id']."' selected>".$pays['nom']."</option>";
                        }
                        else
                        {
                            echo "<option value='".$pays['id']."'>".$pays['nom']."</option>";
                        }
                    }
                    else
                    {
                        echo "<option value='".$pays['id']."'>".$pays['nom']."</option>";
                    }
                }
                ?>
            </select>
        </div>
    </div>
</div>

<?php
if(isset($_POST['idPays']))
{
    if($_POST['idPays'] <> 0)
    {
        include_once('../settings.php');

        global $db;

        $idPays = $_POST['idPays'];

        $db->prepare("select nom,description,drapeau,capitale,nb_habitants,surface,production_arabica,production_robusta from pays where id = ?");
        $tableau = array($idPays);
        $res = $db->execute_prepared_query($tableau);
        ?>
        <div class="container">
            <h1 class="title is-1" style="text-align: center; margin-bottom : 50px">Modification du pays</h1>
            <div class="columns">
                <div class="column is-3 is-offset-3">
                    <form action="modifierPays.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="idPays" value="<?php echo $idPays; ?>">
                        <div class="field">
                            <label class="label">Nom du pays :</label>
                            <p class="control has-icons-left">
                                <input class="input" type="text" name="pays" value="<?php echo $res[0]['nom']; ?>" required>
                                <span class="icon is-small is-left">
                        <i class="fas fa-globe"></i>
                    </span>
                            </p>
                        </div>

                        <div class="field">
                            <label class="label">Description : </label>
                            <div class="control has-icons-left">
                                <textarea name="description" class="textarea"><?php echo $res[0]['description']; ?></textarea>
                            </div>
                        </div>
                        <p class="label">Drapeau</p>
                        <div class="file">
                            <label class="file-label">
                                <input class="file-input" type="file" id="file" name="drapeau">
                                <span class="file-cta">
                  <span class="file-icon">
                    <i class="fas fa-upload"></i>
                  </span>
                  <span id="nomFichier" class="file-label">
                    <?php echo $res[0]['drapeau']; ?>
                  </span>
                </span>
                            </label>
                        </div>

                        <div class="field">
                            <label class="label">Capitale : </label>
                            <div class="control">
                                <input class="input" type="text" name="capitale" value="<?php echo $res[0]['capitale']; ?>" required>
                            </div>
                        </div>

                </div>
                <div class="column is-3 is-offset-1">
                    <h3 class="title is-4">En 2013 : </h3>
                    <div class="field">
                        <label class="label">Nombre d'habitants : </label>
                        <div class="control">
                            <input class="input" type="number" name="nbhabitants" value="<?php echo $res[0]['nb_habitants']; ?>" required>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Surface du pays: </label>
                        <div class="control">
                            <input class="input" type="number" name="surface" value="<?php echo $res[0]['surface']; ?>" required>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Quantité de café produit (arabica) : </label>
                        <div class="control">
                            <input class="input" type="number" name="quantiteArabica" value="<?php echo $res[0]['production_arabica']; ?>" required>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">quantité de café produit (robusta) : </label>
                        <div class="control">
                            <input class="input" type="number" name="quantiteRobusta" value="<?php echo $res[0]['production_robusta']; ?>" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="field is-grouped" style="margin-left: 30%;">
                <div class="control">
                    <input class="button is-text" type="reset" value="Réinitialiser">
                </div>
                <div class="control">
                    <input class="button is-link" type="submit" name="enregistrer" value="Enregistrer">
                </div>
            </div>

            </form>
        </div>
        <?php
    }
}
?>

<script language="JavaScript" type="text/javascript">
    var pays = document.getElementById('pays');

    var chargeDonneesPays = function()
    {
        var idPays = document.getElementById('idPays');
        idPays.value = pays.value;
        document.getElementById("formAfficherModif").submit();
    }

    pays.addEventListener('change', chargeDonneesPays, false);


    var file = document.getElementById('file');

    var changenom = function()
    {
        var tab=file.value.split('\\');
        var nomFichier = document.getElementById('nomFichier');
        nomFichier.innerHTML = tab[2];
    }

    file.addEventListener('change', changenom, false);
</script>

<?php
    get_footer();