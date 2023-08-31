<?php 

session_start();
if (isset($_SESSION['manager_email'])){
    
require '../admin/config.php';
require '../admin/functions.php';
require '../views/header.view.php';
require '../views/navbar.view.php'; 

$errors = '';

$connect = connect($database);
if(!$connect){
	header('Location: ' . SITE_URL . '/controller/error.php');
	} 

$id_user = cleardata($_GET['user']);
$id_diet = cleardata($_GET['diet']);

if(!$id_user && !$id_diet){
	header('Location: ' . SITE_URL . '/controller/home.php');
}

$statement = $connect->prepare("DELETE FROM diets_users WHERE du_diet = :du_diet AND du_user = :du_user");

$statement->execute(array(
	'du_user' => $id_user,
	'du_diet' => $id_diet
));

header('Location: ' . $_SERVER['HTTP_REFERER']);

}else {
		header('Location: ' . SITE_URL . '/controller/login.php');		
		}


?>