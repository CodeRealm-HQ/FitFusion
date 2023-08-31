<?php require'sidebar.php'; ?>

<!--Page Container--> 
<section class="page-container">
  <div class="page-content-wrapper">

    <!--Main Content-->

    <div class="content sm-gutter">
      <div class="container-fluid padding-25 sm-padding-10">
        <div class="row">
          <div class="col-12">
            <div class="section-title">
              <h5>Edit</h5>
            </div>
          </div>

          <div class="col-md-12">
            <div class="block form-block mb-4">

              <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="form-row">

                  <div class="form-group col-md-12">

                   <input type="hidden" value="<?php echo $usr['manager_id']; ?>" name="manager_id">
                   
                   <label class="required">Name</label>
                   <input type="text" value="<?php echo $usr['manager_name']; ?>" name="manager_name" class="form-control" required="">

                   <br/>

                   <label class="required">Email</label>
                   <input type="text" value="<?php echo $usr['manager_email']; ?>" name="manager_email" class="form-control" required="">

                   <br/>

                   <label>Password</label>
                   <input type="hidden" value="<?php echo $usr['manager_password']; ?>" name="manager_password_save">
                   <input type="password" value="" placeholder="" name="manager_password" class="form-control" id="password-field">
                   <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>

                   <br/>

                    <label>Description</label>
                    <textarea type="text" class="mceNoEditor form-control" name="manager_description"><?php echo $usr['manager_description']; ?></textarea>

                   <br/>

                   <label class="control-label">Status</label>

                   <select class="custom-select form-control" name="manager_status">
                    <?php
                    if($usr['manager_status'] == 1){
                      echo '<option value="1" selected="selected">Active</option>';
                      echo '<option value="0">Inactive</option>';

                    } else{
                      echo '<option value="0" selected="selected">Inactive</option>';
                      echo '<option value="1">Active</option>';
                    }
                    ?>
                  </select>

                   <br/>

                   <label class="control-label">Verified</label>

                   <select class="custom-select form-control" name="manager_verified">
                    <?php
                    if($usr['manager_verified'] == 1){
                      echo '<option value="1" selected="selected">Yes</option>';
                      echo '<option value="0">No</option>';

                    } else{
                      echo '<option value="0" selected="selected">No</option>';
                      echo '<option value="1">Yes</option>';
                    }
                    ?>
                  </select>

                  <br/>
                  <br/>

                  <p><b>Registered: </b> <?php echo fecha($usr['manager_created']); ?></p>

                  <hr>

                  <button class="btn btn-primary" type="submit" name="save">Update</button>
                  <button class="btn btn-danger deleteItem" type="button" data-url="../controller/delete_manager.php?id=<?php echo $usr['manager_id']; ?>" data-redirect="../controller/managers.php">Delete</button>

                </div>


              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
