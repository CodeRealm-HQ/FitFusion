<?php 

require '../admin/config.php';
require '../admin/functions.php';

$connect = connect($database);

if (isAdmin($connect) || isAgent($connect)){
    
	session_start();

	session_destroy();
	$_SESSION = array ();

	header('Location: ./login.php');

}else{

    header('Location:'.SITE_URL);
}




?>