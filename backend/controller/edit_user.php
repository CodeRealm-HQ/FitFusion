<?php 

session_start();

require '../classes/firebase/vendor/autoload.php';
 
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

if (isset($_SESSION['manager_email'])){
    
require '../admin/config.php';
require '../admin/functions.php';
require '../views/header.view.php';
require '../views/navbar.view.php'; 

$connect = connect($database);

$id_user = $_GET['id'];
    
if(empty($id_user)){
	header('Location: ' . SITE_URL . '/controller/users.php');
}

$serviceAccount = ServiceAccount::fromJsonFile('../classes/firebase/google-service-account.json');

$firebase = (new Factory)
    ->withServiceAccount($serviceAccount)
    ->create();

$auth = $firebase->getAuth();

$userInfo = $auth->getUser($id_user);

if (!$userInfo){
    header('Location: ' . SITE_URL . '/controller/users.php');
}

$get_all_workouts = get_all_workouts($connect);
$totalworkouts = number_workouts_by_user($connect, $id_user);
$userworkouts = get_workouts_by_user($connect, $id_user);

$get_all_diets = get_all_diets($connect);
$totaldiets = number_diets_by_user($connect, $id_user);
$userdiets = get_diets_by_user($connect, $id_user);

require '../views/edit.user.view.php';
require '../views/footer.view.php';
    
}else {
	header('Location: ' . SITE_URL . '/controller/login.php');		
}


?>