$(document).ready(function(){
	
	var page_settings={};
	
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
	page_settings["selected_forms"] = "";
	$("body").on("click","#select_form_save",function(){
		var value_radio = $( "input:radio[name='view_type']:checked" ).val();
		var position = $("#position").val();
		page_settings["view_type"] = value_radio;
		
		page_settings["position"] = position;
		$("input:checkbox[name='check']:checked").each(function()
		{
    			page_settings["selected_forms"] = page_settings["selected_forms"]+","+$(this).val();
		
			});
		console.log(page_settings);
		
	});
	
});