$(document).ready(function(){
	
	var page_settings={};
	page_settings["selected_form"] = "";
 	$("input[id^='view_type']").click(function(){
		var str="";
		
		str = str + "<option value='main_content'>Main content</option>";
		if(this.value=="3_col_view"){
		
			str = str+"<option value='left_side_bar'>Left side bar</option>";
			str = str+"<option value='right_side_bar'>Right side bar</option>";
		}
		else if(this.value=="2_col_left_view"){
		
			str = str+"<option value='left_side_bar'>Left side bar</option>";
		}
		else{
		
			str = str+"<option value='right_side_bar'>Right side bar</option>";
		}
		
		$("#position").html(str);

	});
	
	$("body").on("click","#select_form_save",function(){
		var counter = 0;
		
		var value_radio = $( "input:radio[name='view_type']:checked" ).val();
		if(value_radio==undefined)
		{
			alert('First select template style');
			
		}
		var position = $("#position").val();
		page_settings["view_type"] = value_radio;
		
		page_settings["position"] = position;
// 		$("input:radio[name='check']:checked").each(function()
// 		{
//     			page_settings["selected_forms"] = page_settings["selected_forms"]+","+$(this).val();
// 		
// 			});
		page_settings["selected_form"] = $("input[name='radio']:checked").val();
		
		page_settings["form_id"] = $("input[name='radio']:checked").attr('id');
		
		console.log(page_settings);
		$('#myModal').modal('toggle');
		
		
	});
	$("#build_page").click(function(){
		//console.log(page_settings);
		$.ajax({
					url: "/laravel_testing/blog/public/save_page_build",
					type:"POST",
					dataType:"json",
					data:page_settings
					})
					.done(function( data ){
						alert('done');
					});
	});
	
});