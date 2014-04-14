$(document).ready(function(){

	$('div').removeClass('alert alert-danger');
	var all_req = new Array();
	var allInputs = $( ":input" );
	///var n = id.search("e_")+2;
	$('body').find(':input').each(function(){
 		
		if($(this).val()==1)
		{
			all_req.push(this.id);
		}
		
	});
	$('#save_form_data').click(function(){
		
		var form_data =  {};
		form_data ['form_data'] =  {};
		form_data["form_id"] = $("#form_id").val();
		form_data["form_name"] = $("#form_name").html();
		var count = 0;
		for(var i=0;i<all_req.length;i++)		
		{
			var n = all_req[i].search("_required");
			var name = all_req[i].substring(0,n);
			
			if($('#'+name).val()=="" || $("#"+name+" :selected").val()==undefined)
			{		
				
				$('#'+name+'_error').addClass('alert alert-danger');
				$('#'+name+'_error').html("This field is required");
				count++;
			}
			else{
				$('#'+name+'_error').html("");
				$('#'+name+'_error').removeClass("alert alert-danger");
			}
		}
		if(count==0)
		{
			var fdata = $('#form').serialize();
			console.log(fdata);
			var field_value = fdata.split('&');
			for(var i=0; i<field_value.length;i++)
			{
				var f  = field_value[i].split('=');
				var field = f[0];
				var value = f[1];
				alert('field='+field+' value='+value);
				form_data["form_data"][field] = value;
			}
			console.log(JSON.stringify(form_data));
			$.ajax({
					url: "/laravel_testing/blog/public/save_form_data",
					type:"POST",
					dataType:"json",
					data:form_data
					})
					.done(function( data ){
						alert('done');
					});
		}
	});
	
	
	
	
});