
  $(function() {
	var json = "";
	var SLT_num = 1;
	var NUM_num = 1;
	var PARAGH_num = 1;
	var CHECK_num = 1;
	var MCHOICE_num = 1;
	var DROPDN_num = 1;
	var flag = 0;
	var option_num_1 = new Array();
	//var option_num_2 = new Array();
	
	//
	
	var field_array =   {};
	
            

	

	$("#form_set").click(function(){
		$('#myModal_MAIN').modal('toggle');
		
		
	});
	//
	$('#save_form_to_db').click(function(){
		
		if(flag == 1)
		{
			var fields_ar = JSON.stringify(field_array);
			var n = fields_ar.search("{");
			var fields = fields_ar.substring(n,fields_ar.length);
			var j = json+ fields+'}';
			console.log(j);
			
			$.ajax({
					url: "/laravel_testing/blog/public/saveForm",
					type:"POST",
// 					
					data:JSON.parse(j)
					})
					.done(function( data ){
						
					});
					alert('Form saved' );

		}
		else{
			alert("Pease fill form settings")
		}



		
	});




	// form -fields addition
	$('#SLT').click(function(){
		var str = "<p class='p_SLT_"+SLT_num+"'><label for='SLT_"+SLT_num+"' name='SLT_"+SLT_num+"_label' id='SLT_"+SLT_num+"_label'>Untitled</label><br>";
		str = str+ "<input type='text' name='SLT_"+SLT_num+"' id ='SLT_"+SLT_num+"' class='field' >";
		str = str+ "<button class='btn btn-success btn-sm set_button' data-toggle='modal' data-target='#myModal_SLT_"+SLT_num+"' id='settings_SLT_"+SLT_num+"'>  Settings</button>";
		str = str+ "<input type='button' class='btn btn-danger btn-sm del_button' id='delete_SLT_"+SLT_num+"' value='Delete'></p>";
		field_array["SLT_"+SLT_num] = {};
		
		modal_builder("SLT","SLT_"+SLT_num,field_array);
		SLT_num++;
		
		$( "#form_holder" ).append( str );	
	});
	 
	$('#NUM').click(function(){
		var str = "<p class='p_NUM_"+NUM_num+"'><label for='NUM_"+NUM_num+"' name='NUM_"+NUM_num+"_label' id='NUM_"+NUM_num+"_label'>Untitled</label><br>";
		str = str+ "<input type='text' name='NUM_"+NUM_num+"' id='NUM_"+NUM_num+"' class='field'>";
		str = str+ "<button class='btn btn-success btn-sm  set_button' data-toggle='modal' data-target='#myModal_NUM_"+NUM_num+"' id='settings_NUM_"+NUM_num+"'>  Settings</button>";
		str = str+ "<input type='button' class='btn btn-danger btn-sm del_button' id='delete_NUM_"+NUM_num+"' value='Delete'></p>";
		field_array["NUM_"+NUM_num] = {};
		
		modal_builder("NUM","NUM_"+NUM_num,field_array);

		NUM_num++;
		$( "#form_holder" ).append( str );	
	});
	$('#PARAGH').click(function(){
		var str = "<p class='p_PARAGH_"+PARAGH_num+"'><label for='PARAGH_"+PARAGH_num+"' name='PARAGH_"+PARAGH_num+"_label' id='PARAGH_"+PARAGH_num+"_label'>Untitled</label><br>";
		str = str+ "<textarea name='PARAGH_"+PARAGH_num+"' id='PARAGH_"+PARAGH_num+"' class='field'></textarea>";
		str = str+ "<button class='btn btn-success btn-sm  set_button' data-toggle='modal' data-target='#myModal_PARAGH_"+PARAGH_num+"' id='settings_PARAGH_"+PARAGH_num+"'>  Settings</button>";
		str = str+ "<input type='button' class='btn btn-danger btn-sm del_button' id='delete_PARAGH_"+PARAGH_num+"' value='Delete'></p>";
		field_array["PARAGH_"+PARAGH_num] = {};
		
		modal_builder("PARAGH","PARAGH_"+PARAGH_num,field_array);

		PARAGH_num++;
		$( "#form_holder" ).append( str );	
	});
	$('#CHECK').click(function(){
		var str = "<p class='p_wid p_CHECK_"+CHECK_num+"'><label for='CHECK_"+CHECK_num+"' name='CHECK_"+CHECK_num+"_label' id='CHECK_"+CHECK_num+"_label'>Untitled</label><br>";
		
		str = str+ "<input type='checkbox' style='margin-right:36%;' name='CHECK_"+CHECK_num+"' id='CHECK_"+CHECK_num+"' >";
		str = str+ "<button class='btn btn-success btn-sm set_button' data-toggle='modal' data-target='#myModal_CHECK_"+CHECK_num+"' id='settings_CHECK_"+CHECK_num+"'>  Settings</button>";
		str = str+ "<input type='button' class='btn btn-danger btn-sm  del_button' id='delete_CHECK_"+CHECK_num+"' value='Delete'></p>";
		field_array["CHECK_"+CHECK_num] = {};
		option_num_1["CHECK_"+CHECK_num] = 2;
		modal_builder("CHECK","CHECK_"+CHECK_num,field_array);

		
		CHECK_num++;
		$( "#form_holder" ).append( str );	
	});
	$('#MCHOICE').click(function(){
		var str = "<p class='p_MCHOICE_"+MCHOICE_num+"'><label for='MCHOICE_"+MCHOICE_num+"' name='MCHOICE_"+MCHOICE_num+"_label' id='MCHOICE_"+MCHOICE_num+"_label'>Untitled</label><br>";
		str = str+ "<select name='MCHOICE_"+MCHOICE_num+"' id='MCHOICE_"+MCHOICE_num+"' class='field'></select>";
		str = str+ "<button class='btn btn-success btn-sm set_button' data-toggle='modal' data-target='#myModal_MCHOICE_"+MCHOICE_num+"' id='settings_MCHOICE_"+MCHOICE_num+"'>  Settings</button>";
		str = str+ "<input type='button' class='btn btn-danger btn-sm  del_button' id='delete_MCHOICE_"+MCHOICE_num+"' value='Delete' ></p>";
		
		field_array["MCHOICE_"+MCHOICE_num] = {};
		option_num_1["MCHOICE_"+MCHOICE_num] = 2;
		
		modal_builder("MCHOICE","MCHOICE_"+MCHOICE_num,field_array);
		MCHOICE_num++;
		$( "#form_holder" ).append( str );	
	});
	$('#DROPDN').click(function(){
		var str = "<p class='p_DROPDN_"+DROPDN_num+"'><label for='DROPDN_"+DROPDN_num+"' name='DROPDN_"+DROPDN_num+"_label' id='DROPDN_"+DROPDN_num+"_label'>Untitled</label><br>";
		str = str+ "<select name='DROPDN_"+DROPDN_num+"' id='DROPDN_"+DROPDN_num+"' class='field'></select>";
		str = str+ "<button class='btn btn-success btn-sm set_button' data-toggle='modal' data-target='#myModal_DROPDN_"+DROPDN_num+"' id='settings_DROPDN_"+DROPDN_num+"'>  Settings</button>";

		str = str+ "<input type='button' class='btn btn-danger btn-sm del_button' id='delete_DROPDN_"+DROPDN_num+"' value='Delete'></p>";
		field_array["DROPDN_"+DROPDN_num] = {};
		option_num_1["DROPDN_"+DROPDN_num] = 2;
		modal_builder("DROPDN","DROPDN_"+DROPDN_num,field_array);
		
		DROPDN_num++;
		$( "#form_holder" ).append( str );	
	});


	$("body").on("click","input[id^='delete_']",function(){
		var id =  $(this).attr('id');
		var n = id.search("e_")+2;
		var name = id.substring(n,id.length);
		
		delete field_array[name];
			

		$(".p_"+name).remove();
		$("#myModal_"+name).remove();
	});

	
	
	$("body").on("click","input[id^='add_options_']",function(){
 		
 		var id =  $(this).attr('id');
		
		var n = id.search("s_")+2;
		var name = id.substring(n,id.length);
		
		var str = "<label for='"+name+"_option_"+option_num_1[name]+"' name='"+name+"_option_"+option_num_1[name]+"_label' id='"+name+"_option_"+option_num_1[name]+"_label'>Option "+option_num_1[name]+"</label><br>";
		
		str = str+ "<input type='text' name='"+name+"_option_"+option_num_1[name]+"' id='"+name+"_option_"+option_num_1[name]+"'><br>";
		option_num_1[name]++;
		$( "#add_fields_"+name ).append( str );	
		
		 
 	});
	$('#save_form_name').click(function(){
		
		var count = 0;

		var form_name = $('#form_name').val();
		$('#form_name_error').removeClass('alert alert-danger');
		$('#form_name_error').html("");
		if(form_name=="")
		{
			$('#form_name_error').html("Form name can't be empty").addClass('alert alert-danger');
			count++;
		}
		
		var form_desc = $('#form_desc').val();
		var form_url = $('#form_url').val();
		
		$('#form_url_error').removeClass('alert alert-danger');
		$('#form_url_error').html("");
		if(form_url=="")
		{
			$('#form_url_error').html("Form url can't be empty").addClass('alert alert-danger');
			count++;
		}
		

		
		if(count==0)
		{
			json =  '{ "form_name" : "'+form_name+'", "form_desc":"'+form_desc+'", "form_url" : "'+form_url+'" , "desc_order":';
			$('#myModal_MAIN').modal('toggle');
			flag = 1;
		}
	});
	
	function modal_builder(type,name,field_array)
	{
		
		
		var str = "<div class='modal fade' id='myModal_"+name+"' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>  <div class='modal-dialog'>    <div class='modal-content'>      <div class='modal-header'>        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>        <h4 class='modal-title' id='myModalLabel'>Field settings</h4>      </div>      <div class='modal-body'>	<div id='settings'>";
		
		str = str + "<div class='form-group'>    <label for='"+name+"_label_1'>Label </label>    <input type='text' class='form-control' id='"+name+"_label_1' placeholder='Enter label' >  </div><div id= '"+name+"_label_1_error'></div>";
		if(type=="PARAGH")
		{
		str = str+ "	  <div class='form-group'>    <label for='"+name+"_default_value'>Default value</label>    <textarea class='form-control' id='"+name+"_default_value' placeholder='Enter default value'></textarea>  </div><div id= '"+name+"_default_value_error'></div>";
	
		}
		else
		{
		str = str+ "	  <div class='form-group'>    <label for='"+name+"_default_value'>Default value</label>    <input type='text' class='form-control' id='"+name+"_default_value' placeholder='Enter default value' >  </div><div id= '"+name+"_default_value_error'></div>";
		
		}

		if(type=='DROPDN' || type=='CHECK')
		{
		str = str + "<input type='button' class='btn btn-success' id='add_options_"+name+"' value='Add options' > <div class='form-group' id='add_fields_"+name+"'>  </div>";
	
		}
		if(type =='MCHOICE')
		{
		str = str+ "<label for='"+name+"_option_"+option_num_1[name]+"' name='"+name+"_option_"+option_num_1[name]+"_label' id='"+name+"_option_"+option_num_1[name]+"_label'>Option "+option_num_1[name]+"</label><br>";
		
		str = str+ "<input type='text' name='"+name+"_option_"+option_num_1[name]+"' id='"+name+"_option_"+option_num_1[name]+"'><br>";
		option_num_1[name]++;
		
		str = str + "<input type='button' class='btn btn-success' id='add_options_"+name+"' value='Add options' > <div class='form-group' id='add_fields_"+name+"'>  </div>";
	
		}




		str = str + " <div class='form-group'>    <label for='"+name+"_css_class_name'>CSS class name</label>    <input type='text' class='form-control' id='"+name+"_css_class_name' placeholder='Enter css class name' >  </div><div id= '"+name+"_default_value_error'></div>";
		
		if(type == 'NUM' || type == 'SLT')
		{
		str = str+ " <div class='form-group'>    <label for='"+name+"_field_size'>Field size</label>    <select id='"+name+"_field_size'>	<option value='small'>Small</option>	<option value='medium'>Medium</option>	<option value='large'>Large</option>	</select>  </div>";
		}


		str = str+ "<div class='form-group'>    <label for='"+name+"_req_field'>Required field</label>	<select id='"+name+"_req_field'>	<option value='1'>YES</option>	<option value='0'>NO</option>	</select>  </div>	";

		str = str + "</div>      <div class='modal-footer'>  <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>        <input type='button' class='btn btn-primary' id='save_field_settings_"+name+"' value='Save changes'>      </div>    </div>  </div> </div>";
		
		$('#modal_holder').append(str);
	}


	// form settings save
	$( "body" ).on( "click", "input[id^='save_field_settings_']", function() {
		
		
		var count=0;
		var id =  $(this).attr('id');
		
		var n = id.search("s_")+2;
		var name = id.substring(n,id.length);
		
		var x = $("#"+name+"_label_1").val();
		$("#"+name+"_label").html(x);
		
		$("#"+name+"_label_1_error").removeClass('alert alert-danger');
		$("#"+name+"_label_1_error").html("");
		if($("#"+name+"_label_1").val()=="")
		{
			$("#"+name+"_label_1_error").html("Label can't be empty").addClass('alert alert-danger');
			count++;
		}
 		var t = name.search("_");
 		var type = name.substring(0,t);
		
		if(type == 'CHECK' || type == 'MCHOICE' || type == 'DROPDN' )
		{
			$("#"+name+"_default_value_error").removeClass('alert alert-danger');
			$("#"+name+"_default_value_error").html("");
			if($("#"+name+"_default_value").val()=="")
			{
				$("#"+name+"_default_value_error").html("Default value can't be empty").addClass('alert alert-danger');
				count++;
			}	
		}
		
		if(count==0)
		{
			$('#myModal_'+name).modal('toggle');
			field_array[name]["label"] = $("#"+name+"_label_1").val();
			field_array[name]["default_value"] = $("#"+name+"_default_value").val();
			field_array[name]["css_class_name"] = $("#"+name+"_css_class_name").val();
			field_array[name]["req_field"] = $("#"+name+"_req_field").val();
			field_array[name]['other_values'] = '';
			if(option_num_1[name]>2)
			{
				
				for(var i =2;i<option_num_1[name];i++)
				{
			
				field_array[name]['other_values'] += $("#"+name+"_option_"+i).val()+",";
				}
			}

		}
		
		});
	
	
	
});
  



