<?php require'sidebar.php'; ?>

<script type="text/javascript">
  $(document).ready(function(){
    $('#table_id').dataTable({
     "bProcessing": true,
     "sAjaxSource": "../controller/get_equipments.php",
     "responsive": true,
     "bPaginate":true,
     "aaSorting": [[1,'desc']],
     "sPaginationType":"full_numbers",
     "iDisplayLength": 10,
     "aoColumns": [
     { mData: 'equipment_id', "width": "1%", "className": "text-center" },
     { "mData": null , "width": "5%", "className": "product text-center",
     "mRender" : function (data) {
      return "<img src='../images/"+data.equipment_image+"' style='width: 50px; height: 50px'/>";}
    },
    { mData: 'equipment_title', "width": "20%"},
    { "mData": null,
    "width": "5%",
    "className": "text-center",
    'orderable': false,
    'searchable': false,
    "mRender" : function (data) {
      return "<a class='btn btn-small btn-primary' href='../controller/edit_equipment.php?id="+data.equipment_id+"'>Edit</a> <a class='btn btn-small btn-danger btn-delete deleteItem' data-url='../controller/delete_equipment.php?id="+data.equipment_id+"'>Delete</a>";}
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
                            <h5>Equipments</h5>
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
