$(document).ready(function(){
	$('#select_form_data').hide();
	var page_settings={};
	page_settings["settings"] = {};
	page_settings["settings"]["form"]= {}
	page_settings["settings"]["form_data"] = {};
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
			if(typeof page_settings["settings"]["form"][id] == "undefined")
			{
			page_settings["settings"]["form"][id] = {};
			}
    			page_settings["settings"]["form"][id]["form_id"] = id;
			page_settings["settings"]["form"][id]["form_name"] = $(this).val();
			page_settings["settings"]["form"][id]["position"] = $("#position_"+id).val(); 
			});
		
		
		
		
		//console.log(page_settings);
		$('#myModal').modal('toggle');
		
		
	});
		
	
	$("body").on("click","#select_form",function(){
		
		var id = $('#form_selector').children(":selected").attr("id");	
		var value_radio = $( "input:radio[name='view_type']:checked" ).val();

		
		$.ajax({
					url: "/laravel_testing/blog/public/generate_form_data_table",
					type:"POST",
					
					data:{"id":id,"radio":value_radio}
					})
					.done(function( d ){
						
						$('#form_data_display').html(d);
					});
		$('#select_form_data').show();
	});	
	$("body").on("click","#select_form_data",function(){
		var form_name = $('#form_selector').children(":selected").val();	
		var form_id = $('#form_selector').children(":selected").attr("id");
		if(typeof page_settings["settings"]["form_data"][form_id] == "undefined")
		{
		
		page_settings["settings"]["form_data"][form_id] = {}
		}
		page_settings["settings"]["form_data"][form_id]["form_id"] = form_id;
		page_settings["settings"]["form_data"][form_id]["form_name"] = form_name;
		if(typeof page_settings["settings"]["form_data"][form_id]["elements"] == "undefined")
		{
		
		page_settings["settings"]["form_data"][form_id]["elements"] = {};
		}
		$("input:checkbox[name='element']:checked").each(function()
		{
			var id = this.id;
			if(typeof page_settings["settings"]["form_data"][form_id]["elements"][id] == "undefined")
			{
				page_settings["settings"]["form_data"][form_id]["elements"][id] = {};
			}
			page_settings["settings"]["form_data"][form_id]["elements"][id]["id"] = id ;
			
			page_settings["settings"]["form_data"][form_id]["elements"][id]["position"] = $("#pos_data_"+form_id+"_"+id).val();
		});	
		alert("data added");
		$("#myModal_2").modal("toggle");
			
	});
	
	$("#build_page").click(function(e){
		
		console.log(page_settings);
		$.ajax({
					url: "/laravel_testing/blog/public/save_page_build",
					type:"POST",
					
					data:page_settings
					})
					.done(function( d ){
						setTimeout(function(){alert("Hello")},3000);
						//alert("page saved");
						//$('#something').html(d);
					});
		return true;
	});
	
	
});