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

$id_manager = cleardata($_GET['id']);

if(!$id_manager){
	header('Location: ' . SITE_URL . '/controller/home.php');
}

$statement = $connect->prepare('DELETE FROM managers WHERE id = :id');
$statement->execute(array('id' => $id_manager));

header('Location: ' . $_SERVER['HTTP_REFERER']);

}else {
		header('Location: ' . SITE_URL . '/controller/login.php');		
		}


?>