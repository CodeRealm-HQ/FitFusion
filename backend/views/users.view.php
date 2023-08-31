<?php require'sidebar.php'; ?>

<script type="text/javascript">
  $(document).ready(function(){
    $.fn.dataTable.ext.errMode = 'throw';
    $('#table_id').dataTable({
     "bProcessing": true,
     "sAjaxSource": "../controller/get_users.php",
     "responsive": true,
     "bPaginate":true,
     "aaSorting": [[5,'desc']],
     "sPaginationType":"full_numbers",
     "iDisplayLength": 10,
     "aoColumns": [
    { mData: 'displayName', "width": "5%"},
    { mData: 'email', "width": "10%"},
    { "mData": null , "width": "5%", "className":"status text-center",
     "mRender" : function (data) {
      if (data.emailVerified == true) {
        return '<span class="badge badge-pill bg-success">Yes</span>';
      }else if(data.emailVerified == false) {
        return '<span class="badge badge-pill bg-warning">No</span>';
      }
      }
    },
    { "mData": null , "width": "5%", "className":"status text-center",
     "mRender" : function (data) {
      if (data.disabled == false) {
        return '<span class="badge badge-pill bg-success">Active</span>';
      }else if(data.disabled == true) {
        return '<span class="badge badge-pill bg-danger">Disabled</span>';
      }
      }
    },
    { "mData": null , "width": "7%",
     "mRender" : function (data) {
      return moment(data.metadata.createdAt).format('DD/MM/YYYY hh:mm:ss');
      }
    },
    { "mData": null,
    "width": "8%",
    "className": "text-center",
    'orderable': false,
    'searchable': false,
    "mRender" : function (data) {

      let buttons = "";
      btns = "<a class='btn btn-small btn-primary' href='../controller/edit_user.php?id="+data.uid+"'>Edit</a> <a class='btn btn-small btn-danger btn-delete deleteItem' data-url='../controller/delete_user.php?id="+data.uid+"'>Delete</a>";
      
      if (data.disabled == false) {
        buttons = btns + " <a class='btn btn-small btn-warning' href='../controller/disable_user.php?id="+data.uid+"'>Disable</a>";
      }else if(data.disabled == true) {
        buttons = btns + " <a class='btn btn-small btn-success' href='../controller/enable_user.php?id="+data.uid+"'>Enable</a>";
      }

      return buttons;
      }
      
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
                            <h5>Users</h5>
                        </div>
                    </div>

<div class="col-12">
                        <div class="block table-block mb-4" style="margin-top: 20px;">

                            <div class="row">
                                <div class="table-responsive">
<table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%" style="border-radius: 5px;">
    <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Verified</th>
                <th>Status</th>
                <th>Joined</th>
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
