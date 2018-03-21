   // add multiple select / deselect functionality
   jQuery(document).ready(function($){
    $("#selectall").click(function () {
      $('.cb').prop('checked', this.checked);
    });

    $(".cb").click(function(){
      if($(".cb").is(':checked')) {

        $("#selectall").prop("checked", true);
      } else {
       $("#selectall").prop("checked", false);

     }

   });
   
   /*$( "#dialog" ).dialog({
	   autoOpen: false,
	   width: 640,
       height: 500,
   });*/

   
   $('.download_file').on('click',function(){
	   var url=$(this).find('.link').val();
	   $('iframe').attr('src',url+'&dl=1');
   });
   
   $('.select_user').on('change',function(){
	   var selected_id = $(this).val();
	   //console.log("selected" + selected_id);
	   if(selected_id!="" || selected_id !="undefined"){
	   $(".loader").show();
	   $.ajax({
				type:"post",
				url:addon_script.ajax_url,
				data:"action="+'get_dropbox_userspage'+'&user_id='+selected_id,
				success:function(result){
					var user_dropboxes = $('#response');
					user_dropboxes.show();
					user_dropboxes.html(result);
					$(".loader").hide();
					$('#folders_select').select2();
				}
		})
	   }
   });
	
 


  });