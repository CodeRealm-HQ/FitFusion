
'use strict';
function deleteAlert(urlItem, reDirect = null) {
  swal({
    title: "Are you sure?",
    text: "You will not be able to recover this item!",
    type: "error",
    cancelButtonClass: "btn-default btn-sm",
    showCancelButton: true,
    cancelButtonText: "Cancel",
    confirmButtonClass: "btn-danger btn-sm",
    confirmButtonText: "Yes, delete it!",
    closeOnConfirm: false },
    function () {
      $.ajax({
        type: 'POST',
        url: urlItem,
        success: function () {
          if (reDirect) {
            window.location.href = reDirect;
          }else{
            location.reload();
          }
        },
        error: function (error) {
          console.log(error);
        }
      });
    });

};

'use strict';
$(document).ready(function(){
  $('.deleteItem').on('click', function(){

    var urlItem = $(this).data('url');
    var reDirect = $(this).data('redirect'); // Redirect page name after delete e.g. "items"

    deleteAlert(urlItem, reDirect);

  });
});

'use strict';
$(document).ready(function(){
  $('#table_id tbody').on('click', '.deleteItem', function(){

    var urlItem = $(this).data('url');
    var reDirect = $(this).data('redirect'); // Redirect page name after delete e.g. "items"

    deleteAlert(urlItem, reDirect);

  });
});

$(document).ready(function() {
	
	// enable fileuploader plugin
	$('input[name="files"]').fileuploader({
        addMore: true
    });
	
});

$(document).ready(function() {
  $.uploadPreview({
    input_field: "#image-upload",   // Default: .image-upload
    preview_box: "#image-preview",  // Default: .image-preview
    label_field: "#image-label",    // Default: .image-label
    label_default: "Choose File",   // Default: Choose File
    label_selected: "Change File",  // Default: Change File
    no_label: false                 // Default: false
  });
});

 $(document).ready(function(){  
      $('.view_data').on('click', function(){  
           var workoutid = $(this).attr("workoutid");  
           var day = $(this).attr("day");  
           $.ajax({  
                url:SITEURL+"/controller/day.php",  
                method:"post",  
                data:{workoutid:workoutid, day:day},  
                success:function(data){  
                     $('#modal_detail').html(data);  
                     $('#dataModal').modal("show");
                     $('#page_list').sortable();
                }  
           });  
      });  
 });

  function saveOrder() {

   var workoutid = $('#page_list').attr("workoutid");  
   var day = $('#page_list').attr("day");  
   
   var page_id_array = new Array();
   $('#page_list li').each(function(){
    page_id_array.push($(this).attr("id"));
   });
   $.ajax({
    url:SITEURL+"/controller/reorder.php",  
    method:"POST",
    data:{page_id_array:page_id_array, day:day, workoutid:workoutid},
    success:function(data)
    {
     //$('#resultAjx').fadeIn();
     //$("#resultAjx").html(data);
     //$('#resultAjx').delay(1000).fadeOut();
     location.reload();
    }
   });
  }

  $(".toggle-password").on('click', function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});

        $(document).ready(function(){
            $(".m_switch_check:checkbox").mSwitch({
                onRender:function(elem){
                    var entity = elem.attr("entity");
                    var label = elem.parent().parent().prev(".m_settings_label");
                    if (elem.val() == 0){
                        $.mSwitch.turnOff(elem);
                        label.html(entity + " <span class=\"m_red\">(Disable)</font>");
                    }else{
                        label.html(entity + " <span class=\"m_green\">(Enable)</font>");
                        $.mSwitch.turnOn(elem);
                    }
                },
                onRendered:function(elem){
                    /*console.log(elem);*/
                },
                onTurnOn:function(elem){
                    var entity = elem.attr("entity");
                    var label = elem.parent().parent().prev(".m_settings_label");
                    if (elem.val() == "0"){
                        elem.val("1");
                        label.html(entity + " <span class=\"m_green\">(Enable)</font>");
                    }else{
                        label.html(entity + " <span class=\"m_red\">(Error)</font>");
                    }
                },
                onTurnOff:function(elem){
                    var entity = elem.attr("entity");
                    var label = elem.parent().parent().prev(".m_settings_label");
                    if (elem.val() == 1){
                        elem.val("0");
                        label.html(entity + " <span class=\"m_red\">(Disable)</font>");
                    }else{
                        label.html(entity + " <span class=\"m_red\">(Error)</font>");
                    }
                }
            });
        });