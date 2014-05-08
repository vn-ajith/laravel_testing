$(document).ready(function()
{
	$("#add_new_user").click(function()
	{
		$("#myModal_1").modal("toggle");
 		
	});
	$("#save_user").click(function(){
		var username = $("#username").val();
		var email = $("#email").val();
		var password = $("#password").val();
		$.ajax({
					url: "/laravel_testing/blog/public/new_user",
					type:"POST",
					data: {"username":username,"email":email,"password":password}
					
					})
					.done(function( d ){
						alert(d);
						
						
					});
		$("#myModal_1").modal("toggle");
	});
	$("#users").click(function(){
		$.ajax({
					url: "/laravel_testing/blog/public/user_list",
					type:"GET"
		
					
					})
					.done(function( d ){
						$("#modal_title").html("Users");
						$("#modal_body").html(d);
						
						
					});
		$("#myModal_2").modal("toggle")	;
	});
	$("#page_viewer").click(function(){
		$.ajax({
					url: "/laravel_testing/blog/public/page_list",
					type:"GET"
		
					
					})
					.done(function( d ){
						$("#modal_title").html("Pages");
						$("#modal_body").html(d);
						
						
					});
		$("#myModal_2").modal("toggle")	;
	});
	$("#search_user").click(function(){
		$("#myModal_3").modal("toggle")	;
		
	});
	$("#search_user_text").keyup(function(){
		var search_text = $("#search_user_text").val();
		$.ajax({
					url: "/laravel_testing/blog/public/search_user",
					type:"GET"
		
					
					})
					.done(function( d ){
						
						$("#search_results").html(d);
						
						
					});
	});
});