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
});