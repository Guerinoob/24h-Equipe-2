<?php
include_once('../includes/utils_page.php');
get_header();

if(isset($_POST['logout'])){
    disconnect_current_user();
}

if(get_logged_user() != null) {
    ?>

    <form method="POST" action="">
        <input type="submit" value="Logout" id="logout" name="logout"/>
    </form>

    !DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>LMF - Connexion</title>
            <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
            <link rel="stylesheet" href="bulma.css">
            <link rel="stylesheet" href="login.css">
            <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.min.css"> -->
            <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
        </head>
        <body>
            <section class="hero has-background-primary">

            </section>
        </body>
    </html>
    <?php
}



var_dump(get_logged_user());



get_footer();