<?php

include '/home/pcspucv/public_html/spm/wp-load.php';

$email = get_userdata(get_current_user_id())->user_email;

var_dump($email);
?>
