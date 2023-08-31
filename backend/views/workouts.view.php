<?php require'sidebar.php'; ?>

<script type="text/javascript">
  $(document).ready(function(){
    $('#table_id').dataTable({
     "bProcessing": true,
     "sAjaxSource": "../controller/get_workouts.php",
     "responsive": true,
     "bPaginate":true,
     "aaSorting": [[1,'desc']],
     "sPaginationType":"full_numbers",
     "iDisplayLength": 10,
     "aoColumns": [
     { mData: 'workout_id', "width": "1%", "className": "text-center" },
     { "mData": null , "width": "10%", "className": "product text-center",
     "mRender" : function (data) {
      return "<img src='../images/"+data.workout_image+"' style='width: 70px; height: 40px; padding: 2px;'/>";}
    },
    { mData: 'workout_title', "width": "20%"},
    { mData: 'goal_title', "width": "8%"},
    { mData: 'level_title', "width": "8%" },
    { mData: 'bodypart_title', "width": "8%" },
    { mData: 'equipment_title', "width": "8%" },
    { mData: 'workout_duration', "width": "10%" },
    { "mData": null , "width": "5%", "className":"status text-center",
     "mRender" : function (data) {
      if (data.workout_status == 1) {
        return '<span class="badge badge-pill bg-success">Active</span>';
      }else if(data.workout_status == 0) {
        return '<span class="badge badge-pill bg-warning">Inactive</span>';
      }
      }
    },
    { "mData": null , "width": "5%", "className":"status text-center",
     "mRender" : function (data) {
      if (data.workout_price == 'free') {
        return '<span>Free</span>';
      }else if(data.workout_price == 'premium') {
        return '<span>Premium</span>';
      }else{
        return '<span>-</span>';
      }
      }
    },
    { "mData": null,
    "width": "13%",
    "className": "text-center",
    'orderable': false,
    'searchable': false,
    "mRender" : function (data) {
      return "<a class='btn btn-small btn-primary' href='../controller/edit_workout.php?id="+data.workout_id+"'>Edit</a> <a class='btn btn-small btn-danger btn-delete deleteItem' data-url='../controller/delete_workout.php?id="+data.workout_id+"'>Delete</a>";}
    }
    ]
  });
  });
</script>

<!--Page Container--> 
<section class="page-container">
    <div class="page-content-wrapper">

        <!--Main Content-->

 <div class="content sm-gutter">
            <div class="container-fluid padding-25 sm-padding-10">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <h5>Workouts</h5>
                        </div>
                    </div>

<div class="col-12">
                        <div class="block table-block mb-4" style="margin-top: 20px;">

                            <div class="row">
                                <div class="table-responsive">
<table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%" style="border-radius: 5px;">
    <thead>
            <tr>
                <th>Id</th>
                <th>Image</th>
                <th>Title</th>
                <th>Goal</th>
                <th>Level</th>
                <th>Muscle</th>
                <th>Equipment</th>
                <th>Duration</th>
                <th>Status</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>

</table>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
