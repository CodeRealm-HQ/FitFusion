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

	$sqlQuery = "SELECT posts.*,tags.tag_title AS tag_title FROM posts,tags WHERE posts.post_tag = tags.tag_id AND posts.post_status = 1";

	if(getParamsID()){

		$sqlQuery .= " AND posts.post_id = '".getParamsID()."'";
	}

	if(getParamsTag()){

        $sqlQuery .= " AND posts.post_tag = '".getParamsTag()."'";
	}

	if(getParamsFeatured()){

        $sqlQuery .= " AND posts.post_featured = '".getParamsFeatured()."'";
	}

	if(getParamsQuery()){

        $sqlQuery .= " AND posts.post_title LIKE '%".getParamsQuery()."%'";
	}

    $sqlQuery .= " ORDER BY posts.post_id DESC";

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

		$id = $row['post_id'];
		$title = $row['post_title'];
		$description = $row['post_description'];
		$image = $row['post_image'];
		$tag = $row['tag_title'];
		$featured = $row['post_featured'];
		$date = $row['post_date'];

		$data[] = array(
			'id'=> $id,
			'title'=> html_entity_decode($title),
			'description'=> html_entity_decode($description),
			'image'=> getImage($image),
			'tag'=> html_entity_decode($tag),
			'featured'=> $featured,
			'date'=> $date
		);
	}

	print json_encode($data, JSON_NUMERIC_CHECK);

?>