<?php
include('../settings.php');


if(!get_logged_user()) {

    authenticate_user_by_username('test', 'test');

}

?>

<a href="page2.php">Page 2</a>
