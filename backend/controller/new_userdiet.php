<?php 

session_start();
if (isset($_SESSION['manager_email'])){
    
    
require '../admin/config.php';
require '../admin/functions.php';

$connect = connect($database);
if(!$connect){
	header ('Location: ' . SITE_URL . '/controller/error.php');
	}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

$user = cleardata($_POST['user_id']);
$diet = cleardata($_POST['diet_id']);

$statment = $connect->prepare( 'INSERT INTO diets_users (du_diet,du_user) VALUES (:du_diet, :du_user)' );

$statment->execute(array(

		':du_diet' => $diet,
		':du_user' => $user
		));

header('Location:' . SITE_URL . '/controller/edit_user.php?id='.$user);

}
    
} else {
		header('Location: ' . SITE_URL . '/controller/login.php');		
		}


?>