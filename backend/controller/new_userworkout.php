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
$workout = cleardata($_POST['workout_id']);

$statment = $connect->prepare("INSERT INTO workouts_users (ws_workout,ws_user) VALUES (:ws_workout, :ws_user)");

$statment->execute(array(

		':ws_workout' => $workout,
		':ws_user' => $user
		));

header('Location:' . SITE_URL . '/controller/edit_user.php?id='.$user);

}
    
} else {
		header('Location: ' . SITE_URL . '/controller/login.php');		
		}


?>