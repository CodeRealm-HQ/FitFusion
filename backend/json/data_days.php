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

if(getParamsID() && getParamsDay()){

	$sqlQuery = "SELECT exercises.*,workouts.workout_id, equipments.equipment_title AS equipment_title, levels.level_title AS level_title FROM exercises JOIN levels ON exercises.exercise_level = levels.level_id JOIN equipments ON exercises.exercise_equipment = equipments.equipment_id";

	if(getParamsID() && getParamsDay() == '1'){

		$sqlQuery .= " JOIN we_day1 ON we_day1.exercise_id = exercises.exercise_id JOIN workouts ON we_day1.workout_id = workouts.workout_id WHERE we_day1.workout_id = ".getParamsID()." GROUP BY we_day1.exercise_id ORDER BY we_day1.eorder ASC";
	}

	if(getParamsID() && getParamsDay() == '2'){

		$sqlQuery .= " JOIN we_day2 ON we_day2.exercise_id = exercises.exercise_id JOIN workouts ON we_day2.workout_id = workouts.workout_id WHERE we_day2.workout_id = ".getParamsID()." GROUP BY we_day2.exercise_id ORDER BY we_day2.eorder ASC";
	}

	if(getParamsID() && getParamsDay() == '3'){

		$sqlQuery .= " JOIN we_day3 ON we_day3.exercise_id = exercises.exercise_id JOIN workouts ON we_day3.workout_id = workouts.workout_id WHERE we_day3.workout_id = ".getParamsID()." GROUP BY we_day3.exercise_id ORDER BY we_day3.eorder ASC";
	}

	if(getParamsID() && getParamsDay() == '4'){

		$sqlQuery .= " JOIN we_day4 ON we_day4.exercise_id = exercises.exercise_id JOIN workouts ON we_day4.workout_id = workouts.workout_id WHERE we_day4.workout_id = ".getParamsID()." GROUP BY we_day4.exercise_id ORDER BY we_day4.eorder ASC";
	}

	if(getParamsID() && getParamsDay() == '5'){

		$sqlQuery .= " JOIN we_day5 ON we_day5.exercise_id = exercises.exercise_id JOIN workouts ON we_day5.workout_id = workouts.workout_id WHERE we_day5.workout_id = ".getParamsID()." GROUP BY we_day5.exercise_id ORDER BY we_day5.eorder ASC";
	}

	if(getParamsID() && getParamsDay() == '6'){

		$sqlQuery .= " JOIN we_day6 ON we_day6.exercise_id = exercises.exercise_id JOIN workouts ON we_day6.workout_id = workouts.workout_id WHERE we_day6.workout_id = ".getParamsID()." GROUP BY we_day6.exercise_id ORDER BY we_day6.eorder ASC";
	}

	if(getParamsID() && getParamsDay() == '7'){

		$sqlQuery .= " JOIN we_day7 ON we_day7.exercise_id = exercises.exercise_id JOIN workouts ON we_day7.workout_id = workouts.workout_id WHERE we_day7.workout_id = ".getParamsID()." GROUP BY we_day7.exercise_id ORDER BY we_day7.eorder ASC";
	}

    if(isset($_GET['page']) && !empty($_GET['page'])) {
        $sqlQuery .= " LIMIT ".$offset.",".$limit;
    }

    if(isset($_GET['limit']) && !empty($_GET['limit']) && !isset($_GET['page'])) {
        $sqlQuery .= " LIMIT ".$limit;
    }
    
    $sentence = $connect->prepare($sqlQuery);

    $sentence->execute();

    $qResults = $sentence->fetchAll(PDO::FETCH_ASSOC);

    }

	$data = array();

	foreach ($qResults as $row) {

	    $id = $row['exercise_id'];
	    $title = $row['exercise_title'];
	    $equipment = $row['exercise_equipment'];
	    $level = $row['exercise_level'];
	    $reps = $row['exercise_reps'];
	    $rest = $row['exercise_rest'];
	    $sets = $row['exercise_sets'];
	    $video = $row['exercise_video'];
	    $image = $row['exercise_image'];
	    $tips = $row['exercise_tips'];
	    $instructions = $row['exercise_instructions'];
	    $equipment_title = $row['equipment_title'];
	    $level_title = $row['level_title'];

		$data[] = array(
		'id'=> $id,
		'title'=> html_entity_decode($title),
		'equipment'=> $equipment,
		'level'=> $level,
		'reps'=> $reps,
		'rest'=> $rest,
		'sets'=> $sets,
		'video'=> $video,
		'image'=> getImage($image),
		'tips'=> $tips,
		'instructions'=> $instructions,
		'equipment_title'=> html_entity_decode($equipment_title),
		'level_title'=> html_entity_decode($level_title),
		);
	}

	print json_encode($data, JSON_NUMERIC_CHECK);

?>