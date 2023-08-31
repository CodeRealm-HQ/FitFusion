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

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	$type_title = cleardata($_POST['type_title']);

	$statment = $connect->prepare(
		"INSERT INTO types (type_id,type_title) VALUES (null, :type_title)");

	$statment->execute(array(
		':type_title' => $type_title,
		));

	header('Location:' . SITE_URL . '/controller/types.php');

}

require '../views/new.type.view.php';
require '../views/footer.view.php';
    
}else {
		header('Location: ' . SITE_URL . '/controller/login.php');		
		}


?>