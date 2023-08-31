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

	$sqlQuery = "SELECT goals.*, (SELECT COUNT(*) FROM workouts WHERE goals.goal_id = workouts.workout_goal) AS total FROM goals ORDER BY goal_id ASC";

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

		$id = $row['goal_id'];
		$title = $row['goal_title'];
		$image = $row['goal_image'];
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