$(document).ready(function(){
	
	var page_settings={};
	page_settings["settings"] = {};
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
		
		$("select[id^='position_']").html(str);

	});
	
	$("body").on("click","#select_form_save",function(){
		var counter = 0;
		
		var value_radio = $( "input:radio[name='view_type']:checked" ).val();
		if(value_radio==undefined)
		{
			alert('First select template style');
			
		}
		
		page_settings["view_type"] = value_radio;
		
		
		$("input:checkbox[name='check']:checked").each(function()
		{
			var id = this.id;
			page_settings["settings"][id] = {};
    			page_settings["settings"][id]["id"] = id;
			page_settings["settings"][id]["form_name"] = $(this).val();
			page_settings["settings"][id]["position"] = $("#position_"+id).val(); 
			});
		
		
		
		
		//console.log(page_settings);
		$('#myModal').modal('toggle');
		
		
	});
		
	$("#select_form").click(function(){
		//var id = $(this).children(":selected").attr("id");
		var id = $('#form_selector').children(":selected").attr("id");	
		page_settings["form_data_include"] = {};
		$.ajax({
					url: "/laravel_testing/blog/public/generate_form_data_table",
					type:"POST",
					
					data:{"id":id}
					})
					.done(function( d ){
						
						$('#form_data_display').html(d);
					});
	});	
	$("#build_page").click(function(){
		console.log(page_settings);
		$.ajax({
					url: "/laravel_testing/blog/public/save_page_build",
					type:"POST",
					
					data:page_settings
					})
					.done(function( d ){
						
						//$('#something').html(d);
					});
	});
	
	
});