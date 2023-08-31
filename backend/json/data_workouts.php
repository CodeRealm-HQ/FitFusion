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

	$sqlQuery = "SELECT workouts.*,goals.goal_title AS goal_title, levels.level_title AS level_title, levels.level_rate AS level_rate, equipments.equipment_title AS equipment_title, bodyparts.bodypart_title AS bodypart_title FROM workouts,goals,levels,equipments,bodyparts WHERE workouts.workout_goal = goals.goal_id AND workouts.workout_level = levels.level_id AND workouts.workout_equipment = equipments.equipment_id AND workouts.workout_bodypart = bodyparts.bodypart_id AND workouts.workout_status = 1";

	if(getParamsID()){

		$sqlQuery .= " AND workouts.workout_id = '".getParamsID()."'";
	}

	if(getParamsGoal()){

        $sqlQuery .= " AND workouts.workout_goal = '".getParamsGoal()."'";
	}

	if(getParamsLevel()){

        $sqlQuery .= " AND workouts.workout_level = '".getParamsLevel()."'";
	}

	if(getParamsMuscle()){

        $sqlQuery .= " AND workouts.workout_bodypart = '".getParamsMuscle()."'";
	}

	if(getParamsEquipment()){

        $sqlQuery .= " AND workouts.workout_equipment = '".getParamsEquipment()."'";
	}

	if(getParamsPrice()){

        $sqlQuery .= " AND workouts.workout_price = '".getParamsPrice()."'";
	}

	if(getParamsUser()){

        $sqlQuery .= " AND workouts.workout_id IN (SELECT workouts_users.ws_workout FROM workouts_users WHERE workouts_users.ws_user = '".getParamsUser()."')";
	}

	if(getParamsQuery()){

        $sqlQuery .= " AND workouts.workout_title LIKE '%".getParamsQuery()."%'";
	}

    $sqlQuery .= " ORDER BY workouts.workout_id DESC";

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

		$id = $row['workout_id'];
		$title = $row['workout_title'];
		$description = $row['workout_description'];
		$image = $row['workout_image'];
		$duration = $row['workout_duration'];
		$goal = $row['goal_title'];
		$level = $row['level_title'];
		$bodypart = $row['bodypart_title'];
		$equipment = $row['equipment_title'];
		$rate = $row['level_rate'];
		$price = $row['workout_price'];

		$data[] = array(
			'id'=> $id,
			'title'=> html_entity_decode($title),
			'description'=> html_entity_decode($description),
			'image'=> getImage($image),
			'duration'=> html_entity_decode($duration),
			'goal'=> html_entity_decode($goal),
			'level'=> html_entity_decode($level),
			'bodypart'=> html_entity_decode($bodypart),
			'equipment'=> html_entity_decode($equipment),
			'rate'=> $rate,
			'price'=> $price
		);
	}

	print json_encode($data, JSON_NUMERIC_CHECK);

?>