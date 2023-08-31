<?php require'sidebar.php'; ?>

<script type="text/javascript">
  $(document).ready(function(){
    $('#table_id').dataTable({
     "bProcessing": true,
     "sAjaxSource": "../controller/get_managers.php",
     "responsive": true,
     "bPaginate":true,
     "sPaginationType":"full_numbers",
     "iDisplayLength": 10,
     "aaSorting": [[1,'desc']],
     "aoColumns": [
     { mData: 'manager_id', "width": "5%", "className": "text-center" },
     { mData: 'manager_name'},
     { mData: 'manager_email'},
     { "mData": null , "width": "5%", "className":"status text-center",
     "mRender" : function (data) {
      if (data.manager_verified == 1) {
        return '<span class="badge badge-pill bg-success">Yes</span>';
      }else if(data.manager_verified == 0) {
        return '<span class="badge badge-pill bg-warning">No</span>';
      }
      }
    },
  { "mData": null , "width": "5%", "className":"status text-center",
     "mRender" : function (data) {
      if (data.manager_status == 1) {
        return '<span class="badge badge-pill bg-success">Active</span>';
      }else if(data.manager_status == 0) {
        return '<span class="badge badge-pill bg-warning">Inactive</span>';
      }
      }
    },
  { "mData": null ,
  "width": "14%",
  "className": "text-center",
  'orderable': false,
  'searchable': false,
  "mRender" : function (data) {
    return "<a class='btn btn-small btn-primary' href='../controller/edit_manager.php?id="+data.manager_id+"'>Edit</a> <a class='btn btn-small btn-danger btn-delete deleteItem' data-url='../controller/delete_manager.php?id="+data.manager_id+"'>Delete</a>";}
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
                            <h5>Managers</h5>
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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Verified</th>
                        <th>Status</th>
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
