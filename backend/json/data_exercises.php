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

	$sqlQuery = "SELECT exercises.*,equipments.equipment_title AS equipment_title,levels.level_title AS level_title, GROUP_CONCAT(bodyparts.bodypart_title) AS bodypart_title FROM exercises JOIN exercises_bodyparts ON exercises_bodyparts.exercise_id = exercises.exercise_id JOIN bodyparts ON bodyparts.bodypart_id = exercises_bodyparts.bodypart_id JOIN equipments ON exercises.exercise_equipment = equipments.equipment_id JOIN levels ON exercises.exercise_level = levels.level_id";

	if(getParamsID()){

		$sqlQuery .= " AND exercises.exercise_id = '".getParamsID()."'";
	}

	if(getParamsEquipment()){

        $sqlQuery .= " AND exercises.exercise_equipment = '".getParamsEquipment()."'";
	}

	if(getParamsLevel()){

        $sqlQuery .= " AND exercises.exercise_level = '".getParamsLevel()."'";
	}

	if(getParamsMuscle()){

        $sqlQuery .= " AND exercises.exercise_id IN (SELECT exercises_bodyparts.exercise_id FROM exercises_bodyparts WHERE exercises_bodyparts.bodypart_id = '".getParamsMuscle()."')";
	}

    $sqlQuery .= " GROUP BY exercises.exercise_id ORDER BY exercises.exercise_id DESC";

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

		$id = $row['exercise_id'];
		$title = $row['exercise_title'];
		$image = $row['exercise_image'];
		$equipment = $row['equipment_title'];
		$level = $row['level_title'];
		$reps = $row['exercise_reps'];
		$rest = $row['exercise_rest'];
		$sets = $row['exercise_sets'];
		$tips = $row['exercise_tips'];
		$instructions = $row['exercise_instructions'];
		$video = $row['exercise_video'];
		$bodyparts = $row['bodypart_title'];

		$data[] = array(
			'id'=> $id,
			'title'=> html_entity_decode($title),
			'image'=> getImage($image),
			'equipment'=> html_entity_decode($equipment),
			'level'=> html_entity_decode($level),
			'reps'=> $reps,
			'rest'=> $rest,
			'sets'=> $sets,
			'tips'=> formatHTML($tips),
			'instructions'=> formatHTML($instructions),
			'video'=> html_entity_decode($video),
			'bodyparts'=> html_entity_decode($bodyparts)
		);
	}

	print json_encode($data, JSON_NUMERIC_CHECK);

?>