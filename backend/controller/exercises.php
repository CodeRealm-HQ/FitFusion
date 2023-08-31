<?php

 session_start();
if (isset($_SESSION['manager_email'])){
    
    
require '../admin/config.php';
require '../admin/functions.php';	
require '../views/header.view.php';
require '../views/navbar.view.php';    

$connect = connect($database);
if(!$connect){
	header('Location: ' . SITE_URL . '/controller/error.php');
	}

require '../views/exercises.view.php';
require '../views/footer.view.php';
    
}else {
		header('Location: ' . SITE_URL . '/controller/login.php');		
		}


?>