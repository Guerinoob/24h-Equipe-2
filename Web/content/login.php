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

<form method="POST" action="" class="col s12">
    <fieldset>
        <legend>Login</legend>

        <div class="input-field">
            <label for="username">Username : </label>
            <input type="text" name="username" id="username" value="<?php if(isset($_POST['username'])) echo $_POST['username']; ?>" />
        </div>

        <div class="input-field">
            <label for="password">Password : </label>
            <input type="password" name="password" id="password" />
        </div>

        <input type="submit" class="btn waves-effect waves-light" id="submit" name="submit" value="Login" />

    </fieldset>
</form>

<?php
get_footer();