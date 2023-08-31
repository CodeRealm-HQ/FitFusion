<?php require'sidebar.php'; ?>

<!--Page Container--> 
<section class="page-container">
    <div class="page-content-wrapper">

        

        <!--Main Content-->

 <div class="content sm-gutter">
            <div class="container-fluid padding-25 sm-padding-10">
                <div class="row">
                    <div class="col-12">
                                        <div class="block-heading d-flex align-items-center title-pages">
                    <h5 class="text-truncate">Edit User</h5>
                </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-block mb-4">

                <div class="row" style="padding-bottom: 20px">

                    <div class="col-12 col-sm-4 col-md-4 col-lg-4">
                        <div class="block counter-block mb-6" style="text-align: left;">

                        <div class="section-title" style="margin-top: 0;">
                            <h4 style="font-size: 18px;">Workouts</h4>
                        </div>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#workouts">
  Add Workout
</button>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#assignedworkouts">
  Assigned Workouts
</button>

                        </div>
                    </div>

                    <div class="col-12 col-sm-4 col-md-4 col-lg-4">
                        <div class="block counter-block mb-6" style="text-align: left;">

                        <div class="section-title" style="margin-top: 0;">
                            <h4 style="font-size: 18px;">Diets</h4>
                        </div>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#diets">
  Add Diet
</button>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#assigneddiets">
  Assigned Diets
</button>

                        </div>
                    </div>

                    <div class="col-12 col-sm-4 col-md-4 col-lg-4">
                        <div class="block counter-block mb-6" style="text-align: left;">

                        <div class="section-title" style="margin-top: 0;">
                            <h4 style="font-size: 18px;">Total</h4>
                        </div>

<p style="text-transform: uppercase; font-size: 13px"><b><?php echo $totalworkouts; ?></b> Total of workouts assigned</p>
<p style="text-transform: uppercase; font-size: 13px"><b><?php echo $totaldiets; ?></b> Total of diets assigned</p>


                        </div>
                    </div>


                    </div>



<div class="form-row">
  <div class="form-group col-md-12">
    <div class="block col-md-12" style="padding-bottom: 35px">

                        <div class="section-title">
                            <h4 style="font-size: 18px;">User Details</h4>
                        </div>


<table class="table table-striped table-bordered" cellspacing="0" width="100%" style="border-radius: 5px;">
    <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Joined</th>
                <th>Last Login</th>
                <th>Status</th>
                <th>Verified</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Joined</th>
                <th>Last Login</th>
                <th>Status</th>
                <th>Verified</th>
            </tr>
        </tfoot>

        <tbody>
            <tr>
              <td><?php echo $userInfo->uid; ?></td>

                <td><?php echo $userInfo->displayName; ?></td>
                <td><?php echo $userInfo->email; ?></td>
                <td class="text-center"><?php echo $userInfo->metadata->createdAt->format('d/m/Y H:i:s'); ?></td>
                <td class="text-center">
                  <?php

                  $dateTime = $userInfo->metadata->lastLoginAt;

                  if ($dateTime) {
                    echo $dateTime->format('d/m/Y H:i:s');
                  }else{
                    echo "-";
                  }

                  ?></td>
                <td class="status text-center">
                    <?php
                    $status = $userInfo->disabled;
                    if ($status == false) {
                        echo '<span class="badge badge-pill bg-success">Active</span>';
                    }else{
                        echo '<span class="badge badge-pill bg-danger">Disabled</span>';
                    }
                    ?>
                </td>
                <td class="status text-center">
                    <?php
                    $status = $userInfo->emailVerified;
                    if ($status == true) {
                        echo '<span class="badge badge-pill bg-success">Yes</span>';
                    }else{
                        echo '<span class="badge badge-pill bg-warning">No</span>';
                    }
                    ?>
                </td>

            </tr>

</tbody>
</table>

<div style="margin-top: 20px">
<?php

    echo "<a class='btn btn-danger' href='../controller/delete_user.php?id=".$userInfo->uid."' style='margin-right: 8px;'>Delete</a>";

  if ($userInfo->disabled === false) {
      echo "<a class='btn btn-warning' href='../controller/disable_user.php?id=".$userInfo->uid."'>Disable</a>";
  }else{
      echo "<a class='btn btn-success' href='../controller/enable_user.php?id=".$userInfo->uid."'>Enable</a>";
  }
?>
</div>


</div>
</div>
</div>

</div>
</div>
</div>
</div>
</div>
</div>
</section>

<div class="modal fade" id="workouts" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Workout for <i><?php echo $userInfo->displayName; ?></i> </h5>
      </div>
      <div class="modal-body">
  
   <label class="control-label">Select Workout</label>
<form enctype="multipart/form-data" action="<?php echo SITE_URL ?>/controller/new_userworkout.php" method="post">
   <input type="hidden" value="<?php echo $userInfo->uid; ?>" name="user_id">
   <select class="my-select form-control" name="workout_id">
    <?php foreach($get_all_workouts as $workout): ?>
   <option data-img-src="<?php echo SITE_URL ?>/images/<?php echo $workout['workout_image']; ?>" value="<?php echo $workout['workout_id']; ?>"><?php echo $workout['workout_title']; ?></option>
    <?php endforeach; ?>
   </select>
         </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add</button>
      </div>
</form>

    </div>
  </div>
</div>

<div class="modal fade" id="assignedworkouts" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Assigned Workouts for <i><?php echo $userInfo->displayName; ?></i> </h5>
      </div>
      <div class="modal-body">
  
          <?php if (!empty($userworkouts)) { ?>
        <table class="table table-bordered" cellspacing="0" width="100%">
          <?php foreach($userworkouts as $workout): ?>
            <tr>
            <td width="40px" align="center"><img src="../images/<?php echo $workout['workout_image']; ?>" style="width: 40px; height: 40px; padding: 2px;"></td>
            <td style="text-align: left; vertical-align: middle;"><div class="ellipsis" style="width: 370px"><?php echo $workout['workout_title']; ?></div></td>
            <td width="30px" style="text-align: center; vertical-align: middle;">
              <a href="../controller/delete_userworkout.php?user=<?php echo $userInfo->uid; ?>&workout=<?php echo $workout['workout_id']; ?>" style="cursor: pointer; font-size: 18px; color: #ab1616; font-weight: 900;"><i class="fa fa-trash-o"></i></a>
            </td>
          </tr>
          <?php endforeach; ?>
        </table>
        <?php }else{ ?>
        <p style="padding: 20px; display: block; text-align: center;">No Workouts Found</p>
        <?php } ?>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="diets" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Diet for <i><?php echo $userInfo->displayName; ?></i> </h5>
      </div>
      <div class="modal-body">
  
   <label class="control-label">Select Diet</label>
<form enctype="multipart/form-data" action="<?php echo SITE_URL ?>/controller/new_userdiet.php" method="post">
   <input type="hidden" value="<?php echo $userInfo->uid; ?>" name="user_id">
   <select class="my-select form-control" name="diet_id">
    <?php foreach($get_all_diets as $diet): ?>
   <option data-img-src="<?php echo SITE_URL ?>/images/<?php echo $diet['diet_image']; ?>" value="<?php echo $diet['diet_id']; ?>"><?php echo $diet['diet_title']; ?></option>
    <?php endforeach; ?>
   </select>
         </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add</button>
      </div>
</form>

    </div>
  </div>
</div>


<div class="modal fade" id="assigneddiets" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Assigned Diets for <i><?php echo $userInfo->displayName; ?></i> </h5>
      </div>
      <div class="modal-body">
  
          <?php if (!empty($userdiets)) { ?>
        <table class="table table-bordered" cellspacing="0" width="100%">
          <?php foreach($userdiets as $diet): ?>
            <tr>
            <td width="40px" align="center"><img src="../images/<?php echo $diet['diet_image']; ?>" style="width: 40px; height: 40px; padding: 2px;"></td>
            <td style="text-align: left; vertical-align: middle;"><div class="ellipsis" style="width: 370px"><?php echo $diet['diet_title']; ?></div></td>
            <td width="30px" style="text-align: center; vertical-align: middle;">
              <a href="../controller/delete_userdiet.php?user=<?php echo $userInfo->uid; ?>&diet=<?php echo $diet['diet_id']; ?>" style="cursor: pointer; font-size: 18px; color: #ab1616; font-weight: 900;"><i class="fa fa-trash-o"></i></a>
            </td>
          </tr>
          <?php endforeach; ?>
        </table>
        <?php }else{ ?>
        <p style="padding: 20px; display: block; text-align: center;">No Diets Found</p>
        <?php } ?>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
