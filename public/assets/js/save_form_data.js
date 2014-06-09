$(document).ready(function(){

	$('div').removeClass('alert alert-danger');
	var all_req = new Array();
	var allInputs = $( ":input" );
	
	$('body').find(':input').each(function(){
 		
		if($(this).val()==1)
		{
			all_req.push(this.id);
		}
		
	});
	$("input[id^='save_form_data']").click(function(){
		
		var save_id = this.id;
		var f = save_id.search("#");
		var fid = save_id.substring(15,save_id.length);
		
		
		var form_data =  {};
		form_data ["form_data"] =  {};
		form_data["form_id"] = $("#form_id_"+fid).val();
		form_data["form_name"] = $("#form_name_"+fid).html();
		var count = 0;
		
		for(var i=0;i<all_req.length;i++)		
		{
			var n = all_req[i].search("_required_"+fid);
			var name = all_req[i].substring(0,n);
			
			var m = name.search("_");
			var type = name.substring(0,m);
			
			if(type=='SLT' || type=='NUM' || type=='PARAGH' || type=='DROPDN')
			{
				var v = $("#"+name+"_"+fid).val();
				if($('#'+name+"_"+fid).val()=="")
				{		
					
					$('#'+name+'_error_'+fid).addClass('alert alert-danger');
					$('#'+name+'_error_'+fid).html("This field is required");
					count++;
				}
				else if(type=='NUM' && $.isNumeric(v) ==false)
				{
					
					$('#'+name+'_error_'+fid).addClass('alert alert-danger');
					$('#'+name+'_error_'+fid).html("This field can only contain numbers");
					count++;
				}
				else{
				
					$('#'+name+'_error_'+fid).html("");
					$('#'+name+'_error_'+fid).removeClass("alert alert-danger");
				}
			}
			else if(type=='CHECK')
			{
				if($("input[id^='"+name+"']").is(':checked')==false)
				{		
					
					$('#'+name+'_error_'+fid).addClass('alert alert-danger');
					$('#'+name+'_error_'+fid).html("This field is required");
					count++;
				}

				else{
				
					$('#'+name+'_error_'+fid).html("");
					$('#'+name+'_error_'+fid).removeClass("alert alert-danger");
				}
			}
			else if(type=='MCHOICE')
			{
				if($("#"+name+"_"+fid+" :selected").val()==undefined)
				{		
					
					$('#'+name+'_error_'+fid).addClass('alert alert-danger');
					$('#'+name+'_error_'+fid).html("This field is required");
					count++;
				}

				else{
				
					$('#'+name+'_error_'+fid).html("");
					$('#'+name+'_error_'+fid).removeClass("alert alert-danger");
				}
			}
			
		}
		
		if(count==0)
		{
			var fdata = $('#form_'+fid).serialize();
			//console.log(fdata);
			var field_value = fdata.split('&');
			
			for(var i=0; i<field_value.length;i++)
			{
				var f  = field_value[i].split('=');
				var field = f[0];
				var label = $("#"+field+"_label_"+fid).html();
					
				label = label.substring(0, label.length - 1);
				
				var value = f[1];
				value = value.replace('+',' ');
				form_data["form_data"][field]={};
				form_data["form_data"][field]['label']=label;
				var key_arr = Object.keys(form_data["form_data"][field]);
					
				if(key_arr.length>=1)
				{
					
					if(key_arr.indexOf(field)>=0)
					{
						form_data["form_data"][field]["value"] = form_data["form_data"][field]["value"]+','+ value;
					}
					else
					{
						form_data["form_data"][field]["value"] = value;
					}
				}
				else
				{
					form_data["form_data"][field]["value"] = value;
				}
				form_data["form_data"][field]["value"] = decodeURIComponent(form_data["form_data"][field]["value"]);
				form_data["form_data"][field]["value"] = form_data["form_data"][field]["value"].replace("+"," ");
				
				
			}
			
			console.log(JSON.stringify(form_data));
			$.ajax({
					url: "../../../../laravel_testing/blog/public/save_form_data",
					type:"POST",
					
					data:form_data
					})
					.done(function( data ){
						alert('Data saved');			
					});
			
		}
	});
	
	
	
	
});