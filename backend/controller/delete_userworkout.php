<?php 

session_start();
if (isset($_SESSION['manager_email'])){
    
require '../admin/config.php';
require '../admin/functions.php';
require '../views/header.view.php';
require '../views/navbar.view.php'; 

$connect = connect($database);

$id_user = cleardata($_GET['user']);
$id_workout = cleardata($_GET['workout']);

if(!$id_user && !$id_workout){
	header('Location: ' . SITE_URL . '/controller/home.php');
}

$statement = $connect->prepare("DELETE FROM workouts_users WHERE ws_workout = :ws_workout AND ws_user = :ws_user");

$statement->execute(array(
	'ws_user' => $id_user,
	'ws_workout' => $id_workout
));

header('Location: ' . $_SERVER['HTTP_REFERER']);

}else{

	header('Location: ' . SITE_URL . '/controller/login.php');		
}


?>