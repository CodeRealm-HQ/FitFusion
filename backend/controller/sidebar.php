<?php

require_once '../admin/config.php';
require_once '../admin/functions.php';

$connect = connect($database);

$user = get_user_information($connect);
$user = $user['0'];

require '../views/sidebar.view.php';

?>