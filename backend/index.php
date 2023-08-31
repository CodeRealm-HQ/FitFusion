<?php 



session_start();

if (isset($_SESSION['manager_email'])){
    
    header('Location: ./controller/home.php');
} else {
    
    header('Location: ./controller/login.php');
}



?>