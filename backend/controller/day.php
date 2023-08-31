<?php  

include '../admin/config.php';

if(isset($_POST["workoutid"]) && isset($_POST["day"])){  

      $output = '';  
      $connect = mysqli_connect($database['host'],$database['user'], $database['pass'], $database['db']);
      $table = "we_day".$_POST['day'];
      $query = "SELECT exercises.exercise_title, exercises.exercise_id, exercises.exercise_image FROM exercises JOIN $table ON $table.exercise_id = exercises.exercise_id JOIN workouts ON $table.workout_id = '".$_POST["workoutid"]."' GROUP BY $table.exercise_id ORDER BY $table.eorder ASC";  
      $result = mysqli_query($connect, $query);

      if (!empty($result)) {
        $output .= '<ul class="list-unstyled" id="page_list" day="'.$_POST["day"].'" workoutid="'.$_POST["workoutid"].'">';  

        while($row = mysqli_fetch_array($result))  
        {  
             $output .= '  
              <li id="'.$row["exercise_id"].'">
              <div style="display: flex; "><div><img src="../images/'.$row["exercise_image"].'" style="width: 80px; height: 60px; padding: 2px;"></div>
              <div class="ellipsis" style="display: flex; align-items: center;">'.$row["exercise_title"].'</div>
              </div>
              </li>
                  ';  
        }  
        $output .= "</ul> <input type='hidden' name='page_order_list' id='page_order_list' />";
      }else{

        $output .= "<span style='display: block; text-align: center;'>No Results Found</span>";

      }

      echo $output;  
 }  
 ?>