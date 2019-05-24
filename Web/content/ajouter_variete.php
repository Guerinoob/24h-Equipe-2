<?php
include('../includes/utils_page.php');
get_header();

$user = get_logged_user();

if($user){
    if(is_exportateur($user->get('id'))){
        echo 'Oui';
    }
}


get_footer();