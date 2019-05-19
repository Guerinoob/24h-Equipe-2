<?php
include_once('../includes/utils_page.php');
get_header();

if(!get_logged_user()) {

    var_dump(authenticate_user_by_username('test', 'test'));

}
?>

<a href="page2.php">Page 2</a>


<?php
get_footer();