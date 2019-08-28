<?php

include '/home/pcspucv/public_html/spm/wp-load.php';
if (is_user_logged_in()) {

    $cu = wp_get_current_user();

    echo 'ID: ' . $cu->ID . '<br />';
    echo 'Nombre de usuario: ' . $cu->user_login . '<br />';
    echo 'Nombre: ' . $cu->user_firstname . '<br />';
    echo 'Apellidos: ' . $cu->user_lastname . '<br />';
    echo 'Nombre publico: ' . $cu->display_name . '<br />';
    echo 'Email: ' . $cu->user_email . '<br />';
    echo 'Web: ' . $cu->user_url . '<br />';
}
?>