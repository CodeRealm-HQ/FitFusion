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
                    <h5 class="text-truncate">New Post</h5>
                </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-block mb-4">

<form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" novalidate>


<div class="form-row">
  <div class="form-group col-md-12">
    <div class="block col-md-12" style="padding-bottom: 35px">

   <label class="control-label">Title</label>
   <input type="text" value="" placeholder="Title" name="post_title" class="form-control" required="">

   <label class="control-label">Description</label>
   <textarea value="" name="post_description" class="advancedtinymce form-control" id="description" required=""></textarea>

   <label class="control-label">Tag</label>
   <select class="form-control" name="post_tag" required="">
    <?php foreach($tags_lists as $tags_list): ?>
   <option value="<?php echo $tags_list['tag_id']; ?>"><?php echo $tags_list['tag_title']; ?></option>
    <?php endforeach; ?>
   </select>

   <label class="control-label">Featured</label>
   
   <style type="text/css">
     td{padding: 0 .5rem !important;}
   </style>
<table>
  <tr>
    <td>                             <div class="radio radio-success">
                                <input type="radio" name="post_featured" id="radio3" value="1">
                                <label for="radio3">
                                    Yes
                                </label>
                            </div></td>
                            <td>
                                                          <div class="radio radio-danger">
                                <input type="radio" name="post_featured" id="radio4" value="0">
                                <label for="radio4">
                                    No
                                </label>
                            </div>
                            </td>
  </tr>

</table>

   <label class="control-label">Status</label>


<table>
  <tr>
    <td>                             <div class="radio radio-success">
                                <input type="radio" name="post_status" id="radio5" value="1">
                                <label for="radio5">
                                    Active
                                </label>
                            </div></td>
                            <td>
                                                          <div class="radio radio-danger">
                                <input type="radio" name="post_status" id="radio6" value="0">
                                <label for="radio6">
                                    Inactive
                                </label>
                            </div>
                            </td>
  </tr>

</table>
   

   <label class="control-label">Image</label>

<div class="new-image" id="image-preview">
  <label for="image-upload" id="image-label">Choose File</label>
  <input type="file" name="post_image" id="image-upload" required="" />
</div>

<span class="text-danger recomendedsize">Recommended size: <b>650 x 350</b> </span>
<br/>
<br/>
   <div class="action-button">
   <input type="submit" name="save" value="Submit" class="btn btn-embossed btn-primary">
   <input type="reset" name="reset" value="Reset" class="btn btn-embossed btn-danger">
   </div>

</div>
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
