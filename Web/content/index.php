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
    <?php
}
    ?>

<a href="page2.php">Page 2</a>


<?php
get_footer();