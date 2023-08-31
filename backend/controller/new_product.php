<?php 

session_start();
if (isset($_SESSION['manager_email'])){
    
require '../admin/config.php';
require '../admin/functions.php';
require '../views/header.view.php';
require '../views/navbar.view.php'; 

$errors = '';

$connect = connect($database);
if(!$connect){
	header('Location: ' . SITE_URL . '/controller/error.php');
	} 

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	$product_title = cleardata($_POST['product_title']);
	$product_description = $_POST['product_description'];
	$product_type = cleardata($_POST['product_type']);
	$product_featured = cleardata($_POST['product_featured']);
	$product_status = cleardata($_POST['product_status']);
	$product_price = cleardata($_POST['product_price']);
	$product_link = cleardata($_POST['product_link']);
	$product_image = $_FILES['product_image']['tmp_name'];

	$imagefile = explode(".", $_FILES["product_image"]["name"]);
	$renamefile = round(microtime(true)) . '.' . end($imagefile);

	$product_image_upload = '../' . $items_config['images_folder'];

	move_uploaded_file($product_image, $product_image_upload . 'product_' . $renamefile);

	$statment = $connect->prepare("INSERT INTO products (product_id,product_title,product_description,product_type,product_featured,product_status,product_price,product_link,product_image) VALUES (null, :product_title, :product_description, :product_type, :product_featured, :product_status, :product_price, :product_link, :product_image)");

	$statment->execute(array(
		':product_title' => $product_title,
		':product_description' => $product_description,
		':product_type' => $product_type,
		':product_featured' => $product_featured,
		':product_status' => $product_status,
		':product_price' => $product_price,
		':product_link' => $product_link,
		':product_image' => 'product_' . $renamefile
		));

	header('Location:' . SITE_URL . '/controller/products.php');

}

$types_lists = get_all_types($connect);

require '../views/new.product.view.php';
require '../views/footer.view.php';
    
}else {

	header('Location: ' . SITE_URL . '/controller/login.php');		
}


?>