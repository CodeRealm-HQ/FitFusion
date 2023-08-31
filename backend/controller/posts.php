<?php

session_start();
if (isset($_SESSION['manager_email'])){
    
require '../admin/config.php';
require '../admin/functions.php';	
require '../views/header.view.php';
require '../views/navbar.view.php';    

require '../views/posts.view.php';
require '../views/footer.view.php';
    
}else {
		header('Location: ' . SITE_URL . '/controller/login.php');		
		}


?>