<?php 

session_start();
if (isset($_SESSION['manager_email'])){
	
	require '../admin/config.php';
	require '../admin/functions.php';
	require '../views/header.view.php';

	$connect = connect($database);
	if(!$connect){
		header('Location: ./error.php');
	} 

		if ($_SERVER['REQUEST_METHOD'] == 'POST'){

			$manager_name = cleardata($_POST['manager_name']);
			$manager_email = cleardata($_POST['manager_email']);
			$manager_verified = cleardata($_POST['manager_verified']);
			$manager_password = cleardata($_POST['manager_password']);
			$encryptPass = hash('sha512', $manager_password);

			$statment = $connect->prepare("INSERT INTO managers (manager_id, manager_name, manager_email, manager_verified, manager_password, manager_created) VALUES (null, :manager_name, :manager_email, :manager_verified, :manager_password, CURRENT_TIMESTAMP)");

			$statment->execute(array(
				':manager_name' => $manager_name,
				':manager_email' => $manager_email,
				':manager_verified' => $manager_verified,
				':manager_password' => $encryptPass
			));

			header('Location: ./managers.php');
		}

		require '../views/new.manager.view.php';
		require '../views/footer.view.php';
	
}else {
	header('Location: ./login.php');		
}


?>