<?php
include_once('../includes/utils_page.php');
get_header();

global $db;

$xmlfile = file_get_contents("https://sql.sh/ressources/sql-pays/sql-pays.xml");
$ob= simplexml_load_string($xmlfile);
$json  = json_encode($ob);
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

    //verif pays
    $verif = 0;
    for($index=0 ; $index<count($configData['database']['table']) ; $index++)
    {
        $pays = str_to_noaccent($configData['database']['table'][$index]['column'][4]);
        if(mb_strtoupper($pays) == mb_strtoupper($paysASave))
        {
            $verif = 1;
            $index = count($configData['database']['table']);
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

}


?>
<form action="ajoutPays.php" method="post" enctype="multipart/form-data">
    <fieldset>
        <legend>Ajout d'un pays</legend>
        <table>
            <tr>
                <td>
                    Nom du pays :
                </td>
                <td>
                    <input type="text" name="pays" placeholder="France" required>
                </td>
            </tr>
            <tr>
                <td>
                    Description :
                </td>
                <td>
                    <textarea name="description" rows="5" placeholder="Ce pays possède beaucoup d'informaticiens" required></textarea>
                </td>
            </tr>
            <tr>
                <td>
                    Drapeau :
                </td>
                <td>
                    <input type="file" name="drapeau">
                </td>
            </tr>
            <tr>
                <td>
                    Capitale :
                </td>
                <td>
                    <input type="text" name="capitale" placeholder="Paris" required>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <fieldset>
                        <legend>En 2013</legend>
                        <table>
                            <tr>
                                <td>
                                    Nombre d'habitants :
                                </td>
                                <td>
                                    <input type="number" name="nbhabitants" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    surface du pays :
                                </td>
                                <td>
                                    <input type="number" name="surface" required> km²
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    quantité de café produit (arabica) :
                                </td>
                                <td>
                                    <input type="number" name="quantiteArabica" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    quantité de café produit (robusta) :
                                </td>
                                <td>
                                    <input type="number" name="quantiteRobusta" required>
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="reset" value="Réinitialiser">
                </td>
                <td>
                    <input type="submit" name="enregistrer" value="Enregistrer">
                </td>
            </tr>
        </table>
    </fieldset>
</form>
<?php
get_footer();
?>