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

	$product_title = cleardata($_POST['product_title']);
	$product_description = $_POST['product_description'];
	$product_type = cleardata($_POST['product_type']);
	$product_id = cleardata($_POST['product_id']);
	$product_featured = cleardata($_POST['product_featured']);
	$product_status = cleardata($_POST['product_status']);
	$product_price = cleardata($_POST['product_price']);
	$product_link = cleardata($_POST['product_link']);
	$product_image_save = $_POST['product_image_save'];
	$product_image = $_FILES['product_image'];

	if (empty($product_image['name'])) {
		$product_image = $product_image_save;
	} else{
			$imagefile = explode(".", $_FILES["product_image"]["name"]);
			$renamefile = round(microtime(true)) . '.' . end($imagefile);
		$product_image_upload = '../' . $items_config['images_folder'];
		move_uploaded_file($_FILES['product_image']['tmp_name'], $product_image_upload . 'product_' . $renamefile);
		$product_image = 'product_' . $renamefile;
	}

$statment = $connect->prepare("UPDATE products SET product_title = :product_title, product_description = :product_description, product_type = :product_type, product_featured = :product_featured, product_status = :product_status, product_price = :product_price, product_link = :product_link, product_image = :product_image WHERE product_id = :product_id");

$statment->execute(array(

		':product_title' => $product_title,
		':product_description' => $product_description,
		':product_type' => $product_type,
		':product_featured' => $product_featured,
		':product_status' => $product_status,
		':product_price' => $product_price,
		':product_link' => $product_link,
		':product_image' => $product_image,
		':product_id' => $product_id

		));

header('Location: ' . $_SERVER['HTTP_REFERER']);

} else{

$id_product = id_product($_GET['id']);
    
if(empty($id_product)){
	header('Location: ' . SITE_URL . '/controller/home.php');
	}

$product = get_product_per_id($connect, $id_product);
    
    if (!$product){
    header('Location: ' . SITE_URL . '/controller/home.php');
}

$product = $product['0'];

}

$types_lists = get_all_types($connect);

require '../views/edit.product.view.php';
require '../views/footer.view.php';
    
} else {
		header('Location: ' . SITE_URL . '/controller/login.php');		
		}


?>