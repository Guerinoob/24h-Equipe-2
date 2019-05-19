<?php
include_once('../includes/utils_page.php');
get_header();

global $users;
var_dump($users->get_meta(1, 'meta_test'));

var_dump(get_logged_user());

get_footer();