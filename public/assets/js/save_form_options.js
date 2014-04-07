
  $(function() {
	var json = "";
	var SLT_num = 1;
	var NUM_num = 1;
	var PARAGH_num = 1;
	var CHECK_num = 1;
	var MCHOICE_num = 1;
	var DROPDN_num = 1;
	var option_num_1 = 1;
	var option_num_2 = 1;
	//$('#myModal').modal(data-show="true");
	$('#myModal_3').modal('toggle');

	$("#send_json").click(function(){
		
		var d = {
			"form_name":"a",
			"form_desc":"b",
			"form_url":234,
			"desc_order":{
					"a":{
						"q":"y",
						"w":2
						},
					"b":{
						"q":"z",
						"w":3
						}
					}
			};
		$.ajax({
				url: "/laravel_testing/blog/public/saveForm",
				type:"POST",
				dataType:"json",
				data: d		
				})
				.done(function( data ) {
					alert('done');
				});
	});
	//




	// form -fields addition
	$('#SLT').click(function(){
		var str = "<label for='SLT_"+SLT_num+"' name='SLT_"+SLT_num+"_label' id='SLT_"+SLT_num+"_label'>Untitled</label><br>";
		str = str+ "<input type='text' name='SLT_"+SLT_num+"' id ='SLT_"+SLT_num+"' >";
		str = str+ "<button class='btn btn-success btn-sm' data-toggle='modal' data-target='#myModal'>  Settings</button><br>";
		SLT_num++;
		$( "#form_holder" ).append( str );	
	});
	 
	$('#NUM').click(function(){
		var str = "<label for='NUM_"+NUM_num+"' name='NUM_"+NUM_num+"_label' id='NUM_"+NUM_num+"_label'>Untitled</label><br>";
		str = str+ "<input type='text' name='NUM_"+NUM_num+"' id='NUM_"+NUM_num+"'>";
		str = str+ "<button class='btn btn-success btn-sm' data-toggle='modal' data-target='#myModal'>  Settings</button><br>";
		NUM_num++;
		$( "#form_holder" ).append( str );	
	});
	$('#PARAGH').click(function(){
		var str = "<label for='PARAGH_"+PARAGH_num+"' name='PARAGH_"+PARAGH_num+"_label' id='PARAGH_"+PARAGH_num+"_label'>Untitled</label><br>";
		str = str+ "<textarea name='PARAGH_"+PARAGH_num+"'></textarea>";
		str = str+ "<button class='btn btn-success btn-sm' data-toggle='modal' data-target='#myModal'>  Settings</button><br>";
		PARAGH_num++;
		$( "#form_holder" ).append( str );	
	});
	$('#CHECK').click(function(){
		var str = "<label for='CHECK_"+CHECK_num+"' name='CHECK_"+CHECK_num+"_label' id='CHECK_"+CHECK_num+"_label'>Untitled</label><br>";
		
		str = str+ "<input type='checkbox' name='CHECK_"+CHECK_num+"'>";
		str = str+ "<button class='btn btn-success btn-sm' data-toggle='modal' data-target='#myModal'>  Settings</button><br>";
		
		
		CHECK_num++;
		$( "#form_holder" ).append( str );	
	});
	$('#MCHOICE').click(function(){
		var str = "<label for='MCHOICE_"+MCHOICE_num+"' name='MCHOICE_"+MCHOICE_num+"_label' id='MCHOICE_"+MCHOICE_num+"_label'>Untitled</label><br>";
		str = str+ "<select name='MCHOICE_"+MCHOICE_num+"'></select>";
		str = str+ "<button class='btn btn-success btn-sm' data-toggle='modal' data-target='#myModal_2'>  Settings</button><br>";
		MCHOICE_num++;
		$( "#form_holder" ).append( str );	
	});
	$('#DROPDN').click(function(){
		var str = "<label for='DROPDN_"+DROPDN_num+"' name='DROPDN_"+DROPDN_num+"_label' id='DROPDN_"+DROPDN_num+"_label'>Untitled</label><br>";
		str = str+ "<select name='DROPDN_"+DROPDN_num+"'></select>";
		str = str+ "<button class='btn btn-success btn-sm' data-toggle='modal' data-target='#myModal_4'>  Settings</button><br>";
		DROPDN_num++;
		$( "#form_holder" ).append( str );	
	});


	$('#add_options').click(function(){
		var str = "<label for='m_option_"+option_num_1+"' name='m_option_"+option_num_1+"_label' id='m_option_"+option_num_1+"_label'>Option "+option_num_1+"</label><br>";
		option_num_1++;
		str = str+ "<input type='text' name='m_option_"+option_num_1+"' id='m_option_"+option_num_1+"'><br>";
		$( "#add_fields" ).append( str );	
		 
	});
	$('#add_options_1').click(function(){
		var str = "<label for='d_option_"+option_num_2+"' name='d_option_"+option_num_2+"_label' id='d_option_"+option_num_2+"_label'>Option "+option_num_2+"</label><br>";
		option_num_2++;
		str = str+ "<input type='text' name='d_option_"+option_num_2+"' id='d_option_"+option_num_2+"'><br>";
		$( "#add_fields_1" ).append( str );	
		 
	});
	// form settings save
	$( "body" ).on( "click", "#save_field_setting", function() {
		
		//('#myModal').modal('toggle');
		alert($('#label').val());
		$('#SLT_1_label').html('it worked');

		});
	
	$('#save_form_name').click(function(){
		
		
		var form_name = $('#form_name').val();
		var form_desc = $('#form_desc').val();
		var form_url = $('#form_url').val();
		json = json + '{ "form_name" : "'+form_name+'", "form_desc":"'+form_desc+'", "form_url" : "'+form_url+'" , "desc_order":';
		alert(json);
		$('#myModal_3').modal('toggle');
	});
	
});
  



