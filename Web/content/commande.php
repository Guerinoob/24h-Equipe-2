<?php
include_once('../includes/utils_page.php');
get_header();


$user = get_logged_user();

if($user){
    if(is_importateur($user->get('id'))){

        global $db;

        if(isset($_POST['submit'])){
            $pays = $_POST['pays'];
            $type_cafe = $_POST['type_cafe'];
            $quantite = $_POST['quantite'];

            /*if(!is_int($quantite)){
                echo 'Le stock doit être un nombre entier !';
            }
            else{
                $req_insert = "INSERT INTO varietes(id_type_cafe, id_pays, stock, id_exportateur) VALUES(?, ?, ?, ?)";
                $args = array($type_cafe, $pays, $quantite, $user->get('id'));

                if($db->prepare($req_insert)){
                    if($db->execute_prepared_query($args)){
                        echo 'La variété a été ajoutée !';
                    }
                    else{
                        echo 'Erreur execute';
                    }
                }
                else{
                    echo 'Erreur prepare';
                }
            }*/

            var_dump($_POST);

        }


        $req_types = "SELECT * FROM type_cafe";
        $req_pays = "SELECT id, nom FROM pays";


        $types = $db->query_get_rows($req_types);
        $liste_pays = $db->query_get_rows($req_pays);


        // À mettre en AJAX sur changement d'exportateur$req_quantite_restante = "SELECT stock FROM varietes":


        ?>


        <div class="column is-3 is-offset-3">
            <form method="post" action="#">
                <div class="field">
                    <label for="type_cafe" class="label">Type de café</label>
                    <div class="control">
                        <div class="select">
                            <select name="type_cafe" id="type_cafe">
                                <?php

                                foreach($types as $type){
                                    echo '<option value="'.$type['id'].'">'.$type['nom'].'</option>';
                                }

                                ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="field">
                    <label for="pays" class="label">Origine du café</label>
                    <div class="control is-expanded">
                        <div class="select is-fullwidth">
                            <select name="pays" id="pays">
                                <?php

                                foreach($liste_pays as $pays){
                                    echo '<option value="'.$pays['id'].'">'.$pays['nom'].'</option>';
                                }

                                ?>
                            </select>
                        </div>
                    </div>
                </div>

                <label for="quantite" class="label">Quantité de café <span id="quantite_restante"></span> </label>
                <p class="control">
                    <input class="input" type="number" name="quantite" id="quantite" placeholder="Quantité">
                </p>

                <div class="field">
                    <label for="exportateur" class="label">Choix de l'exportateur</label>
                    <div class="control is-expanded">
                        <div class="select is-fullwidth">
                            <select name="exportateur" id="exportateur">
                                <option value="-1">Choississez un type de café et un pays...</option>
                            </select>
                        </div>
                    </div>
                </div>


                <br/>


                <div class="field is-grouped">
                    <div class="control">
                        <input type="submit" id="submit" name="submit" value="Submit" class="button is-link" />
                    </div>
                    <div class="control">
                        <button class="button is-text">Cancel</button>
                    </div>
                </div>
            </form>
        </div>

        <script>
            $(document).ready(function(){

                function get_exportateurs(){
                    var type_actuel = $('#type_cafe').val();
                    var pays_actuel = $('#pays').val();

                    $.post(
                        'get_exportateurs_commande.php',
                        {
                            'type_cafe': type_actuel,
                            'pays': pays_actuel
                        },
                        function(response){
                            $('#exportateur').html(response);

                        }
                    );
                }
                var exportateur_select = $('');
                var type_cafe_select = $('#type_cafe');

                $('#pays').on('change', get_exportateurs);
                $('#type_cafe').on('change', get_exportateurs);

                $('#exportateur').on('change', function(){
                    var exportateur = $('#exportateur').val();
                    var type_actuel = $('#type_cafe').val();
                    var pays_actuel = $('#pays').val();

                    $.post(
                        'get_quantite_restante.php',
                        {
                            'pays': pays_actuel,
                            'type_cafe': type_actuel,
                            'exportateur': exportateur
                        },
                        function(response){
                            $('#quantite_restante').html(response);
                        }
                    )
                });
            });
        </script>

        <?php

    }
}


get_footer();