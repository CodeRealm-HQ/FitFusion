<?php

$page = 1;
if(!empty($_GET['page'])) {
    $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
    if(false === $page) {
        $page = 1;
    }
}

$limit = 10;
if(!empty($_GET['limit'])) {
    $limit = filter_input(INPUT_GET, 'limit', FILTER_VALIDATE_INT);
}

$offset = ($page - 1) * $limit;

header('Content-Type: application/json');
header("access-control-allow-origin: *");

require './app_core.php';

	$sqlQuery = "SELECT products.*,types.type_title AS type_title FROM products,types WHERE products.product_type = types.type_id AND products.product_status = 1";

	if(getParamsID()){

		$sqlQuery .= " AND products.product_id = '".getParamsID()."'";
	}

	if(getParamstype()){

        $sqlQuery .= " AND products.product_type = '".getParamstype()."'";
	}

	if(getParamsFeatured()){

        $sqlQuery .= " AND products.product_featured = '".getParamsFeatured()."'";
	}

	if(getParamsQuery()){

        $sqlQuery .= " AND products.product_title LIKE '%".getParamsQuery()."%'";
	}

    $sqlQuery .= " ORDER BY products.product_id DESC";

    if(isset($_GET['page']) && !empty($_GET['page'])) {
        $sqlQuery .= " LIMIT ".$offset.",".$limit;
    }

    if(isset($_GET['limit']) && !empty($_GET['limit']) && !isset($_GET['page'])) {
        $sqlQuery .= " LIMIT ".$limit;
    }
    
    $sentence = $connect->prepare($sqlQuery);

    $sentence->execute();

    $qResults = $sentence->fetchAll(PDO::FETCH_ASSOC);

	$data = array();

	foreach ($qResults as $row) {

		$id = $row['product_id'];
		$title = $row['product_title'];
		$description = $row['product_description'];
		$image = $row['product_image'];
		$type = $row['type_title'];
		$featured = $row['product_featured'];
		$price = $row['product_price'];
		$link = $row['product_link'];

		$data[] = array(
			'id'=> $id,
			'title'=> html_entity_decode($title),
			'description'=> formatHTML($description),
			'image'=> getImage($image),
			'type'=> html_entity_decode($type),
			'featured'=> $featured,
			'price'=> $price,
			'link'=> html_entity_decode($link)
		);
	}

	print json_encode($data, JSON_NUMERIC_CHECK);

?>