<?php 

session_start();
if (isset($_SESSION['manager_email'])){
    
require '../admin/config.php';
require '../admin/functions.php';
require '../views/header.view.php';
require '../views/navbar.view.php'; 

$connect = connect($database);
if(!$connect){
	header ('Location: ' . SITE_URL . '/controller/error.php');
	}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	$type_title = cleardata($_POST['type_title']);
	$type_id = cleardata($_POST['type_id']);

$statment = $connect->prepare(
	"UPDATE types SET type_title = :type_title WHERE type_id = :type_id"
	);

$statment->execute(array(

		':type_title' => $type_title,
		':type_id' => $type_id

		));

header('Location: ' . $_SERVER['HTTP_REFERER']);

} else{

$id_type = id_type($_GET['id']);
    
if(empty($id_type)){
	header('Location: ' . SITE_URL . '/controller/home.php');
	}

$type = get_type_per_id($connect, $id_type);
    
    if (!$type){
    header('Location: ' . SITE_URL . '/controller/home.php');
}

$type = $type['0'];

}

require '../views/edit.type.view.php';
require '../views/footer.view.php';
    
} else {
		header('Location: ' . SITE_URL . '/controller/login.php');		
		}


?>