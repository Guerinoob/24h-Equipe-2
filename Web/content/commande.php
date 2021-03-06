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
            $exportateur = $_POST['exportateur'];

            $req_stock = "SELECT stock FROM varietes WHERE id_type_cafe = ? AND id_pays = ? AND id_exportateur = ?";
            $args = array($type_cafe, $pays, $exportateur);

            if($db->prepare($req_stock)){
                if($results = $db->execute_prepared_query($args)[0]){

                    if($results['stock'] < $quantite){
                        echo 'Il n\' y a pas assez de café en stock !';
                    }
                    else{
                        $req_insert = "INSERT INTO commandes(id_type_cafe, id_pays, quantite, id_exportateur, id_importateur, date) VALUES(?, ?, ?, ?, ?, ?)";

                        $args = array($type_cafe, $pays, $quantite, $exportateur, $user->get('id'), date('Y-m-d', time()));

                        if($db->prepare($req_insert)){
                            if($db->execute_prepared_query($args)){
                                echo 'La commande a été passée !';

                            }
                            else{
                                echo 'Erreur execute';
                            }
                        }
                        else{
                            echo 'Erreur prepare';
                        }
                    }

                }
                else{
                    echo 'Erreur execute stock';
                }
            }
            else{
                echo 'Erreur prepare stock';
            }

        }


        $req_types = "SELECT * FROM type_cafe";
        $req_pays = "SELECT id, nom FROM pays";


        $types = $db->query_get_rows($req_types);
        $liste_pays = $db->query_get_rows($req_pays);



        ?>


        <section class="hero is-primary has-background-light is-fullheight">
        <div class="hero-body has-text-centered">
        <div class="container">
            <h1 class="title is-2 has-text-dark">Passer une commande</h1>
        <div class="column is-4 is-offset-4">
            <div class="box" style="border-radius: 20px;">
            <form method="post" action="">
                <div class="field">
                    <label for="type_cafe" class="label">Type de café</label>
                    <div class="control is-expanded">
                        <div class="select is-fullwidth">
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
                        <p class="button is-text">Cancel</p>
                    </div>
                </div>
            </form>
        </div>
        </div>
        </div>
        </div>
        </section>

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