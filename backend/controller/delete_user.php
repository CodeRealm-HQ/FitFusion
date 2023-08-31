<?php

require '../classes/firebase/vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

session_start();
if(isset($_SESSION['manager_email'])){
    
require '../admin/config.php';
require '../admin/functions.php';

$serviceAccount = ServiceAccount::fromJsonFile('../classes/firebase/google-service-account.json');

$firebase = (new Factory)
    ->withServiceAccount($serviceAccount)
    ->create();

$auth = $firebase->getAuth();

$uid = cleardata($_GET['id']);

if(!$uid){

	header('Location: ' . SITE_URL . '/controller/home.php');

}else{

    $updatedUser = $auth->deleteUser($uid);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

}else{
	
    header('Location: ' . SITE_URL . '/controller/login.php');		
}

?>
