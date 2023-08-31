<?php

require '../admin/config.php';
require '../admin/functions.php';

$connect = connect($database);

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

$table = "we_day".$_POST['day'];

for($i=0; $i<count($_POST["page_id_array"]); $i++){

$statment = $connect->prepare("UPDATE $table SET eorder = :eorder WHERE workout_id = '".$_POST["workoutid"]."' AND exercise_id = '".$_POST["page_id_array"][$i]."'");

$statment->execute(array(
		':eorder' => $i,
		));
}

echo '<span style="display: block; padding: 11px; margin: 17px 33px 2px 18px; color: #28a745; border: 1px solid; border-radius: 6px; background: #e4ffe4; text-align: center;">Order has been updated</span>';

}


?>