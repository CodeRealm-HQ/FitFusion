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

	$tag_title = cleardata($_POST['tag_title']);
	$tag_id = cleardata($_POST['tag_id']);

$statment = $connect->prepare(
	"UPDATE tags SET tag_title = :tag_title WHERE tag_id = :tag_id"
	);

$statment->execute(array(

		':tag_title' => $tag_title,
		':tag_id' => $tag_id

		));

header('Location: ' . $_SERVER['HTTP_REFERER']);

} else{

$id_tag = id_tag($_GET['id']);
    
if(empty($id_tag)){
	header('Location: ' . SITE_URL . '/controller/home.php');
	}

$tag = get_tag_per_id($connect, $id_tag);
    
    if (!$tag){
    header('Location: ' . SITE_URL . '/controller/home.php');
}

$tag = $tag['0'];

}

require '../views/edit.tag.view.php';
require '../views/footer.view.php';
    
} else {
		header('Location: ' . SITE_URL . '/controller/login.php');		
		}


?>