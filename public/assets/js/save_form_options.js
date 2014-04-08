
  $(function() {
	var json = "";
	var SLT_num = 1;
	var NUM_num = 1;
	var PARAGH_num = 1;
	var CHECK_num = 1;
	var MCHOICE_num = 1;
	var DROPDN_num = 1;
	var option_num_1 = new Array();
	//var option_num_2 = new Array();
	
	//
	
	var field_array =   {};
	
            

	

	$("#form_set").click(function(){
		$('#myModal_MAIN').modal('toggle');
		
		
	});
	//
	$('#save_form_to_db').click(function(){
		
		var fields_ar = JSON.stringify(field_array);
		var n = fields_ar.search("{");
		var fields = fields_ar.substring(n,fields_ar.length);
		var j = json+ fields+'}';
		
		/*
		var e = { "form_name" : "d",
			  "form_desc":"f", 
			  "form_url" : "f" ,
			  "desc_order":
					{ 
					"SLT_1":
						{
						"label":"w",
						"default_value":"h",
						"css_class_name":"w",
						"req_field":"1",
						"other_values":""
					}
				}
			};
		*/$.ajax({
				url: "/laravel_testing/blog/public/saveForm",
				type:"POST",
				dataType:"json",
				data: JSON.parse(j)
				})
				.done(function( data ) {
					alert('done');
				});





// 		$.ajax({
// 				url: "/laravel_testing/blog/public/saveForm",
// 				type:"POST",
// 				dataType:"json",
// 				data: j		
// 				})
// 				.done(function( data ) {
// 					alert('done');
// 				});
		
		
	});




	// form -fields addition
	$('#SLT').click(function(){
		var str = "<label for='SLT_"+SLT_num+"' name='SLT_"+SLT_num+"_label' id='SLT_"+SLT_num+"_label'>Untitled</label><br>";
		str = str+ "<input type='text' name='SLT_"+SLT_num+"' id ='SLT_"+SLT_num+"' >";
		str = str+ "<button class='btn btn-success btn-sm' data-toggle='modal' data-target='#myModal_SLT_"+SLT_num+"'>  Settings</button><br>";
		field_array["SLT_"+SLT_num] = {};
		
		modal_builder("SLT","SLT_"+SLT_num,field_array);
		SLT_num++;
		
		$( "#form_holder" ).append( str );	
	});
	 
	$('#NUM').click(function(){
		var str = "<label for='NUM_"+NUM_num+"' name='NUM_"+NUM_num+"_label' id='NUM_"+NUM_num+"_label'>Untitled</label><br>";
		str = str+ "<input type='text' name='NUM_"+NUM_num+"' id='NUM_"+NUM_num+"'>";
		str = str+ "<button class='btn btn-success btn-sm' data-toggle='modal' data-target='#myModal_NUM_"+NUM_num+"'>  Settings</button><br>";
		
		field_array["NUM_"+NUM_num] = {};
		
		modal_builder("NUM","NUM_"+NUM_num,field_array);

		NUM_num++;
		$( "#form_holder" ).append( str );	
	});
	$('#PARAGH').click(function(){
		var str = "<label for='PARAGH_"+PARAGH_num+"' name='PARAGH_"+PARAGH_num+"_label' id='PARAGH_"+PARAGH_num+"_label'>Untitled</label><br>";
		str = str+ "<textarea name='PARAGH_"+PARAGH_num+"'></textarea>";
		str = str+ "<button class='btn btn-success btn-sm' data-toggle='modal' data-target='#myModal_PARAGH_"+PARAGH_num+"'>  Settings</button><br>";
		field_array["PARAGH_"+PARAGH_num] = {};
		
		modal_builder("PARAGH","PARAGH_"+PARAGH_num,field_array);

		PARAGH_num++;
		$( "#form_holder" ).append( str );	
	});
	$('#CHECK').click(function(){
		var str = "<label for='CHECK_"+CHECK_num+"' name='CHECK_"+CHECK_num+"_label' id='CHECK_"+CHECK_num+"_label'>Untitled</label><br>";
		
		str = str+ "<input type='checkbox' name='CHECK_"+CHECK_num+"'>";
		str = str+ "<button class='btn btn-success btn-sm' data-toggle='modal' data-target='#myModal_CHECK_"+CHECK_num+"'>  Settings</button><br>";
		field_array["CHECK_"+CHECK_num] = {};
		
		modal_builder("CHECK","CHECK_"+CHECK_num,field_array);

		
		CHECK_num++;
		$( "#form_holder" ).append( str );	
	});
	$('#MCHOICE').click(function(){
		var str = "<label for='MCHOICE_"+MCHOICE_num+"' name='MCHOICE_"+MCHOICE_num+"_label' id='MCHOICE_"+MCHOICE_num+"_label'>Untitled</label><br>";
		str = str+ "<select name='MCHOICE_"+MCHOICE_num+"'></select>";
		str = str+ "<button class='btn btn-success btn-sm' data-toggle='modal' data-target='#myModal_MCHOICE_"+MCHOICE_num+"'>  Settings</button><br>";
		
		field_array["MCHOICE_"+MCHOICE_num] = {};
		option_num_1["MCHOICE_"+MCHOICE_num] = 2;
		
		modal_builder("MCHOICE","MCHOICE_"+MCHOICE_num,field_array);
		MCHOICE_num++;
		$( "#form_holder" ).append( str );	
	});
	$('#DROPDN').click(function(){
		var str = "<label for='DROPDN_"+DROPDN_num+"' name='DROPDN_"+DROPDN_num+"_label' id='DROPDN_"+DROPDN_num+"_label'>Untitled</label><br>";
		str = str+ "<select name='DROPDN_"+DROPDN_num+"'></select>";
		str = str+ "<button class='btn btn-success btn-sm' data-toggle='modal' data-target='#myModal_DROPDN_"+DROPDN_num+"'>  Settings</button><br>";

		field_array["DROPDN_"+DROPDN_num] = {};
		option_num_1["DROPDN_"+DROPDN_num] = 2;
		modal_builder("DROPDN","DROPDN_"+DROPDN_num,field_array);
		
		DROPDN_num++;
		$( "#form_holder" ).append( str );	
	});


	

	// form settings save
	$( "body" ).on( "click", "input[id^='save_field_settings_']", function() {
		
		var id =  $(this).attr('id');
		
		var n = id.search("s_")+2;
		var name = id.substring(n,id.length);

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
		$('#myModal_'+name).modal('toggle');
		
		});
	
	$("body").on("click","input[id^='add_options_']",function(){
 		
 		var id =  $(this).attr('id');
		
		var n = id.search("s_")+2;
		var name = id.substring(n,id.length);
		
		var str = "<label for='"+name+"_option_"+option_num_1[name]+"' name='"+name+"_option_"+option_num_1[name]+"_label' id='"+name+"_option_"+option_num_1[name]+"_label'>Option "+option_num_1[name]+"</label><br>";
		
		str = str+ "<input type='text' name='"+name+"_option_"+option_num_1[name]+"' id='"+name+"_option_"+option_num_1[name]+"'><br>";
		option_num_1[name]++;
		$( "div[id^='add_fields_']" ).append( str );	
		
		 
 	});
	$('#save_form_name').click(function(){
		
		
		var form_name = $('#form_name').val();
		var form_desc = $('#form_desc').val();
		var form_url = $('#form_url').val();
		json =  '{ "form_name" : "'+form_name+'", "form_desc":"'+form_desc+'", "form_url" : "'+form_url+'" , "desc_order":';
		
		$('#myModal_MAIN').modal('toggle');
	});
	
	function modal_builder(type,name,field_array)
	{
		
		
		var str = "<div class='modal fade' id='myModal_"+name+"' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>  <div class='modal-dialog'>    <div class='modal-content'>      <div class='modal-header'>        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>        <h4 class='modal-title' id='myModalLabel'>Field settings</h4>      </div>      <div class='modal-body'>	<div id='settings'>";
		
		str = str + "<div class='form-group'>    <label for='"+name+"_label_1'>Label </label>    <input type='text' class='form-control' id='"+name+"_label_1' placeholder='Enter label' value='"+field_array[name]["label"]+"'>  </div>";
		if(type=="PARAGH")
		{
		str = str+ "	  <div class='form-group'>    <label for='"+name+"_default_value'>Default value</label>    <textarea class='form-control' id='"+name+"_default_value' placeholder='Enter default value'>"+field_array[name]["default"]+"</textarea>  </div>";
	
		}
		else
		{
		str = str+ "	  <div class='form-group'>    <label for='"+name+"_default_value'>Default value</label>    <input type='text' class='form-control' id='"+name+"_default_value' placeholder='Enter default value' value='"+field_array[name]["default"]+"'>  </div>";
		
		}

		if(type=='DROPDN' || type =='MCHOICE')
		{
		str = str + "<input type='button' class='btn btn-success' id='add_options_"+name+"' value='Add options' > <div class='form-group' id='add_fields_"+name+"'>  </div>";
	
		}




		str = str + " <div class='form-group'>    <label for='"+name+"_css_class_name'>CSS class name</label>    <input type='text' class='form-control' id='"+name+"_css_class_name' placeholder='Enter css class name' value='"+field_array[name]["css_class_name"]+"'>  </div>";
		
		if(type == 'NUM' || type == 'SLT')
		{
		str = str+ " <div class='form-group'>    <label for='"+name+"_field_size'>Field size</label>    <select id='"+name+"_field_size'>	<option value='small'>Small</option>	<option value='medium'>Medium</option>	<option value='large'>Large</option>	</select>  </div>";
		}


		str = str+ "<div class='form-group'>    <label for='"+name+"_req_field'>Required field</label>	<select id='"+name+"_req_field'>	<option value='1'>YES</option>	<option value='0'>NO</option>	</select>  </div>	";

		str = str + "</div>      <div class='modal-footer'>  <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>        <input type='button' class='btn btn-primary' id='save_field_settings_"+name+"' value='Save changes'>      </div>    </div>  </div> </div>";
		
		$('#modal_holder').append(str);
	}
	
	
	
});
  



