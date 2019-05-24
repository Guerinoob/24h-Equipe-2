<?php
include_once('../includes/utils_page.php');
get_header();

global $db;

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
    echo 'document.location="ajoutPays.php";';
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
    if ($_FILES['drapeau']['error'] > 0)
    {
        erreur('erreur image drapeau');
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

    ////RECUPERATION EXTENSION
    $tabExt = explode('.',$_FILES['drapeau']['name']);

    ////ATTRIBUTION DES VARIOABLE EN ENLVANT LES ACCENTS
    $paysASave = str_to_noaccent($_POST["pays"]);
    $descriptionASave = str_to_noaccent($_POST["description"]);
    $drapeauASave = str_to_noaccent(mb_strtolower($paysASave).".".$tabExt[1]);
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

    ////VERIF SI PAYS NEST PAS DEJA ENREGISTRER
    $db->prepare("select count(*) from pays where upper(nom) = ?");
    $tableauVerifPaysExistant = array(strtoupper($paysASave));
    $tabCount = $db->execute_prepared_query($tableauVerifPaysExistant);
    if($tabCount[0]['count(*)'] > 0)
    {
        erreur($paysASave.' déjà enregistrer');
    }

    ////INSERTION PAYS
    $db->prepare("insert into pays(nom,description,drapeau,capitale,nb_habitants,surface,production_arabica,production_robusta)
                    values(?,?,?,?,?,?,?,?)");
    $tableauAInserer = array($paysASave,$descriptionASave,$drapeauASave,$capitaleASave,$nbhabitantsASave,$surfaceASave,$quantiteArabicaASave,$quantiteRobustaASave);
    $db->execute_prepared_query($tableauAInserer);

    ////COPIE DU DRAPEAU DANS LE DOSSIER IMAGE
    $resultat = move_uploaded_file($_FILES['drapeau']['tmp_name'],"image/".$drapeauASave);

    erreur2('Pays bien enregistré');

    /*$results = $db->prepare("SELECT id from pays where nom = ?");
    if($results) {
        $array = array($paysASave);
        $results = $db->execute_prepared_query($array);
        if ($results) {
            $ch = curl_init();
            $dir = preg_replace('/ajoutPays.php/', '', $_SERVER["PHP_SELF"], 1);
            $path = $_SERVER["REQUEST_SCHEME"]."://".$_SERVER["SERVER_NAME"].$dir;
            curl_setopt($ch, CURLOPT_URL, $path."/createIcon?pays=".$results[0]["id"].".php");
            curl_setopt($ch, CURLOPT_HEADER, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_exec($ch);
            curl_close($ch);

        }
    }*/

}


?>
    <div class="container">
        <h1 class="title is-1" style="text-align: center; margin-bottom : 50px">Ajout d'un pays</h1>
        <div class="columns">
            <div class="column is-3 is-offset-3">
                <form action="ajoutPays.php" method="post" enctype="multipart/form-data">



                    <div class="field">
                        <label class="label">Nom du pays :</label>
                        <p class="control has-icons-left">
                            <input class="input" type="text" name="pays" placeholder="France" required>
                            <span class="icon is-small is-left">
                    <i class="fas fa-globe"></i>
                </span>
                        </p>
                    </div>

                    <div class="field">
                        <label class="label">Description : </label>
                        <div class="control has-icons-left">
                            <textarea name="description" class="textarea" placeholder="     Ce pays possède beaucoup d'informaticiens"></textarea>

                            <span class="icon has-text-info">
                        <i class="fas fa-info-circle"></i>
                    </span>
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
                Choisissez un fichier...
              </span>
            </span>
                        </label>
                    </div>

                    <div class="field">
                        <label class="label">Capitale : </label>
                        <div class="control">
                            <input class="input" type="text" name="capitale" placeholder="Paris" required>
                        </div>
                    </div>

            </div>
            <div class="column is-3 is-offset-1">
                <h3 class="title is-4">En 2013 : </h3>
                <div class="field">
                    <label class="label">Nombre d'habitants : </label>
                    <div class="control">
                        <input class="input" type="number" name="nbhabitants" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Surface du pays: </label>
                    <div class="control">
                        <input class="input" type="number" name="surface" placeholder="km²" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Quantité de café produit (arabica) : </label>
                    <div class="control">
                        <input class="input" type="number" name="quantiteArabica" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label">quantité de café produit (robusta) : </label>
                    <div class="control">
                        <input class="input" type="number" name="quantiteRobusta" required>
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
<script>
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
?>