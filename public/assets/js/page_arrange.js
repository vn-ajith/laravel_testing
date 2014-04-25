$(document).ready(function(){


		
	$("input[id^='save_form_data']").attr("disabled", "disabled");
	$("div[id^='main_']").sortable({
	});
	$("div[id^='left_']").sortable({
	});
	$("div[id^='right_']").sortable({
	});
	$("#left").sortable({
	});
	$("div[id^='main_']").disableSelection();
	$("div[id^='left_']").disableSelection();
	$("div[id^='right_']").disableSelection();
	
	var page_order = {};
		var i=1;
	$("#save_page_order").click(function(){
		
		if($("div[id^='left_']").html()!=undefined)
		{
			
			page_order["left"] = {};
		
			$("div[id^='left_'] div[id^='box_']").each(function(){
				var box_id = this.id.substring(4,this.id.length);
				page_order["left"]["item#"+i]  = box_id;
				i++;
 				
			});
			
		}
		if($("div[id^='main_']").html()!=undefined)
		{
			page_order["main"] = {};

			$("div[id^='main_'] div[id^='box_']").each(function(){
				var box_id = this.id.substring(4,this.id.length);
				page_order["main"]["item#"+i] = box_id;
				i++;
			});
		
		}
		if($("div[id^='right_']").html()!=undefined)
		{
			page_order["right"] = {};
			$("div[id^='right_'] div[id^='box_']").each(function(){
				var box_id = this.id.substring(4,this.id.length);
				page_order["right"]["item#"+i] = box_id;
				i++;
			});
			
		}
		console.log(page_order);
		var page_id = $("#page_id").val();
		$.ajax({
					url: "/laravel_testing/blog/public/save_page_order",
					type:"POST",
					
					data:{"page_order":page_order,"page_id":page_id}
					})
					.done(function( d ){
						setTimeout(function(){alert("Hello")},3000);
						//alert("page saved");
						//$('#something').html(d);
					});
		
	});
	
	
});