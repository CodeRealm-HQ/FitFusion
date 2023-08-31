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

	$sqlQuery = "SELECT bodyparts.*, (SELECT COUNT(*) FROM exercises_bodyparts WHERE bodyparts.bodypart_id = exercises_bodyparts.bodypart_id) AS total FROM bodyparts ORDER BY total DESC";

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

		$id = $row['bodypart_id'];
		$title = $row['bodypart_title'];
		$image = $row['bodypart_image'];
		$total = $row['total'];

		$data[] = array(
			'id'=> $id,
			'title'=> html_entity_decode($title),
			'image'=> getImage($image),
			'total'=> $total
		);
	}

	print json_encode($data, JSON_NUMERIC_CHECK);

?>