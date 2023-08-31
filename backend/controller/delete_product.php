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

$id_product = cleardata($_GET['id']);

if(!$id_product){
	header('Location: ' . SITE_URL . '/controller/home.php');
}

$statement = $connect->prepare('DELETE FROM products WHERE product_id = :product_id');
$statement->execute(array('product_id' => $id_product));

header('Location: ' . $_SERVER['HTTP_REFERER']);

}else {
		header('Location: ' . SITE_URL . '/controller/login.php');		
		}


?>