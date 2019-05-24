<?php
include_once('../includes/utils_page.php');
get_header();

if(isset($_POST['submit'])){
    $non_remplis = array();

    foreach($_POST as $key=>$value){
        if(empty($value))
            $non_remplis[] = $key;
    }

    if(count($non_remplis) > 0){

    }
    else{
        $username = $_POST['username'];
        $password = $_POST['password'];

        $auth = authenticate_user_by_username($username, $password);

        if(!$auth){
            echo 'Erreur';
        }
        else{
            echo 'Connexion réussie !';
        }
    }
}

?>



    <section class="hero is-primary has-background-grey-darker is-fullheight">
        <div class="hero-body has-text-centered">
            <div class="container">
                <div class="column is-6 is-offset-3">
                    <div class="box" style="border-radius: 20px;">
                        <h1 class="title has-text-info has-text-weight-bold">SE CONNECTER</h1>
                        <div class="stroke-line is-center"></div>
                        <form action="" method="POST">
                            <div class="field">
                                <div class="control has-icons-left has-icons-right">
                                    <label>
                                        <input placeholder="Nom d'utilisateur" class="input" type="text" name="username" id="username" value="<?php if(isset($_POST['username'])) echo $_POST['username']; ?>" />
                                        <span class="icon is-small is-left">
                                                <i class="fas fa-user"></i>
                                            </span>
                                        <span class="icon is-small is-right">
                                                <i class="fas fa-check"></i>
                                            </span>
                                    </label>
                                </div>
                            </div>
                            <div class="field">
                                <div class="control has-icons-left">
                                    <label>
                                        <input placeholder="Mot de passe" class="input" type="password" name="password" id="password" />
                                        <span class="icon is-small is-left">
                                                <i class="fas fa-lock"></i>
                                            </span>
                                    </label>
                                </div>
                            </div>

                            <button class="button is-block is-info is-fullwidth has-text-weight-medium">Connexion</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
get_footer();