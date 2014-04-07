<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Form builder</title>
  <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>	
  
  
  <style>
  h1 { padding: .2em; margin: 0; }
	#forms_builder ul { float:left;}
  
  
  
  
  </style>
  <script>
  $(function() {
	var json = "";
	var SLT_num = 1;
	var NUM_num = 1;
	var PARAGH_num = 1;
	var CHECK_num = 1;
	var MCHOICE_num = 1;
	var DROPDN_num = 1;
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

	$('#SLT').click(function(){
		var str = "<label for='SLT_"+SLT_num+"' name='SLT_"+SLT_num+"_label'>Untitled</label><br>";
		str = str+ "<input type='text' name='SLT_"+SLT_num+"' id ='SLT_"+SLT_num+"' >";
		str = str+ "<button class='btn btn-success btn-sm' data-toggle='modal' data-target='#myModal'>  Settings</button><br>";
		SLT_num++;
		$( "#form_holder" ).append( str );	
	});
	 $( "body" ).on( "click", "#clicked", function() {
		
		//('#myModal').modal('toggle');
		alert('hi');

		});
	$('#NUM').click(function(){
		var str = "<label for='NUM_"+NUM_num+"' name='NUM_"+NUM_num+"_label'>Untitled</label><br>";
		str = str+ "<input type='text' name='NUM_"+NUM_num+"'><br>";
		NUM_num++;
		$( "#form_holder" ).append( str );	
	});
	$('#PARAGH').click(function(){
		var str = "<label for='PARAGH_"+PARAGH_num+"' name='PARAGH_"+PARAGH_num+"_label'>Untitled</label><br>";
		str = str+ "<textarea name='PARAGH_"+PARAGH_num+"'></textarea><br>";
		PARAGH_num++;
		$( "#form_holder" ).append( str );	
	});
	$('#CHECK').click(function(){
		var str = "<label for='CHECK_"+CHECK_num+"' name='CHECK_"+CHECK_num+"_label'>Untitled</label><br>";
		
		str = str+ "<input type='checkbox' name='CHECK_"+CHECK_num+"'><br>";
		CHECK_num++;
		$( "#form_holder" ).append( str );	
	});
	$('#MCHOICE').click(function(){
		var str = "<label for='MCHOICE_"+MCHOICE_num+"' name='MCHOICE_"+MCHOICE_num+"_label'>Untitled</label><br>";
		str = str+ "<select name='MCHOICE_"+MCHOICE_num+"'></select><br>";
		MCHOICE_num++;
		$( "#form_holder" ).append( str );	
	});
	$('#DROPDN').click(function(){
		var str = "<label for='DROPDN_"+DROPDN_num+"' name='DROPDN_"+DROPDN_num+"_label'>Untitled</label><br>";
		str = str+ "<select name='DROPDN_"+DROPDN_num+"'></select><br>";
		DROPDN_num++;
		$( "#form_holder" ).append( str );	
	});
// 	$('#clicked').click(function(){
// 		//$( "#SLT_1" ).before( $( ".clicked" ) ).value="aj";
// 		alert('config');
// 	});
	//$('#clicked').click(function(){alert('hi')}); 
	
	
});
  </script>
</head>
<body>
 
<div id="form_builder" class="panel panel-default">
  <h1 class="">Form builder</h1>
  
    <h2>Fields</h2>
    <div class="panel-body">
      <ul>
        <li ><input type="button" id = "SLT" value="Single line text" class="btn btn-primary"></li>
        <li ><input type="button" id = "NUM" value="Number" class="btn btn-primary"></li>
        <li ><input type="button" id = "PARAGH" value="Paragraph text" class="btn btn-primary"></li>
	<li ><input type="button" id = "CHECK" value="Checkboxes" class="btn btn-primary"></li>
	<li ><input type="button" id = "MCHOICE" value="Multiple choice" class="btn btn-primary"></li>
	<li ><input type="button" id = "DROPDN" value="Dropdown" class="btn btn-primary"></li>
      </ul>
    </div>

	
  
</div>
<div id="form_holder">
	
</div> 


<!-- Modal for setting  -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Field settings</h4>
      </div>
      <div class="modal-body">
        ...
	


	<div id="settings">
  <div class="form-group">
    <label for="label">Label </label>
    <input type="text" class="form-control" id="label" placeholder="Enter label">
  </div>

  <div class="form-group">
    <label for="default_value">Password</label>
    <input type="text" class="form-control" id="default_value" placeholder="Enter default value">
  </div>

  <div class="form-group">
    <label for="css_class_name">CSS class name</label>
    <input type="text" class="form-control" id="css_class_name" placeholder="Enter css class name">
  </div>

  <div class="form-group">
    <label for="field_size">Field size</label>
    <select id="field_size">
	<option value="small">Small</option>
	<option value="medium">Medium</option>
	<option value="large">Large</option>
	</select>
  </div>
	<div class="form-group">
    <label for="req_field">Required field</label>
    
	<select id="req_field">
	<option value="1">YES</option>
	<option value="0">NO</option>
	
	</select>
  </div>	

</div>










      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<!-- End of settings for modal -->




<!--  <img src="{{asset('assets/images/fanssignupsplash.png')}}"> -->
 <br>
<!-- <input type="button" id="send_json" value="Send json" > -->
</body>
</html>