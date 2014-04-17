$(document).ready(function(){
	
	var page_settings={};
	
	
	page_settings["selected_forms"] = "";
	$("body").on("click","#select_form_save",function(){
		var value_radio = $( "input:radio[name='view_type']:checked" ).val();
		page_settings["view_type"] = value_radio;
		$("input:checkbox[name='check']:checked").each(function()
		{
    			page_settings["selected_forms"] = page_settings["selected_forms"]+","+$(this).val();
		
			});
		console.log(page_settings);
	});
	
});