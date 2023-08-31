<?php 


session_start();
if (isset($_SESSION['manager_email'])){
	
	require '../admin/config.php';
	require '../admin/functions.php';
	require '../views/header.view.php';

	$connect = connect($database);

	$id = id_manager($_GET['id']);

	if ( empty($_GET["id"]) ) {
		header('Location: ./home.php');
	}

		if ($_SERVER['REQUEST_METHOD'] == 'POST'){

			$manager_id = cleardata($_POST['manager_id']);
			$manager_name = cleardata($_POST['manager_name']);
			$manager_email = cleardata($_POST['manager_email']);
			$manager_description = cleardata($_POST['manager_description']);
			$manager_verified = cleardata($_POST['manager_verified']);
			$manager_status = cleardata($_POST['manager_status']);

			$encryptPass = hash('sha512', $password);

			$password_save = $_POST['manager_password_save'];
			$password = $_POST['manager_password'];


			if (empty($password)) {
				$password = $password_save;
			} else{
				
				$password = hash('sha512', $password);
			}

			$statment = $connect->prepare(
				"UPDATE managers SET manager_id = :manager_id, manager_name = :manager_name, manager_email = :manager_email, manager_description = :manager_description, manager_verified = :manager_verified, manager_status = :manager_status, manager_password = :manager_password WHERE manager_id = :manager_id"
			);

			$statment->execute(array(

				':manager_id' => $manager_id,
				':manager_name' => $manager_name,
				':manager_email' => $manager_email,
				':manager_description' => $manager_description,
				':manager_verified' => $manager_verified,
				':manager_status' => $manager_status,
				':manager_password' => $password,

			));

			header('Location: ' . $_SERVER['HTTP_REFERER']);

		}else{

			$id_manager = id_manager($_GET['id']);

			$usr = get_manager_per_id($connect, $id_manager);

			if (!$usr){
				header('Location: ./home.php');
			}

			$usr = $usr['0'];

			require '../views/edit.manager.view.php';

		}

	require '../views/footer.view.php';
	
} else {
	header('Location: ./login.php');		
}


?>