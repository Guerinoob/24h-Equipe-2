<?php
include_once('../settings.php');

global $db;

$idPays = $_POST['id'];

$db->prepare("select nom,description,drapeau,capitale,nb_habitants,surface,production_arabica,production_robusta from pays where id = ?");
$tableau = array($idPays);
$res = $db->execute_prepared_query($tableau);

echo $res[0]['nom']." ";
echo $res[0]['description']." ";
echo $res[0]['drapeau']." ";
echo $res[0]['capitale']." ";
echo $res[0]['nb_habitants']." ";
echo $res[0]['surface']." ";
echo $res[0]['production_arabica']." ";
echo $res[0]['production_robusta'];
?>
<div class="container">
    <h1 class="title is-1" style="text-align: center; margin-bottom : 50px">Modification du pays</h1>
    <div class="columns">
        <div class="column is-3 is-offset-3">
            <form action="ajoutPays.php" method="post" enctype="multipart/form-data">



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

                        <span class="icon has-text-info">
                        <i class="fas fa-info-circle"></i>
                    </span>
                    </div>
                </div>
                <p class="label">Drapeau</p>
                <div class="file">
                    <label class="file-label">
                        <input class="file-input" type="file" name="drapeau">
                        <span class="file-cta">
              <span class="file-icon">
                <i class="fas fa-upload"></i>
              </span>
              <span class="file-label">
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
