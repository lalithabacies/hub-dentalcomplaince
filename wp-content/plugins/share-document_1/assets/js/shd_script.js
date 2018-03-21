jQuery(document).ready(function($){
	$("#search_butt").click(function(){
			var search_course = $("#search_course").val();
			$('.loader_img').show();
			$.ajax({
				type:"post",
				url:shd_script.shdajaxurl,
				data:"search_course="+search_course+"&action="+'get_certificate_response',
				success:function(result1){
					$('.loader_img').hide();
					$("#response").html(result1);
				}
			});
	});
	
	$("#search_butt_user").click(function(){
			var search_user = $("#search_user").val();
			$('.loader_img').show();
			$.ajax({
				type:"post",
				url:shd_script.shdajaxurl,
				data:"search_user="+search_user+"&action="+'get_status_response',
				success:function(result2){
					$('.loader_img').hide();
					$("#response1").html(result2);
				}
			});
	});
})
