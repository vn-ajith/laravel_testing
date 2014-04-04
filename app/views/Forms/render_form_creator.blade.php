<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>jQuery UI Droppable - Shopping Cart Demo</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <style>
  h1 { padding: .2em; margin: 0; }
  #products { float:left; width: 500px; margin-right: 2em; }
  #cart { width: 200px; float: left; margin-top: 1em; }
  /* style the list to maximize the droppable hitarea */
  #cart ol { margin: 0; padding: 1em 0 1em 3em; }
  </style>
  <script>
  $(function() {
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
		var str = "<input type='text' name='SLT_"+SLT_num+"'><br>";
		SLT_num++;
		$( "#form_holder" ).append( str );	
	});
	$('#NUM').click(function(){
		var str = "<input type='text' name='NUM_"+NUM_num+"'><br>";
		NUM_num++;
		$( "#form_holder" ).append( str );	
	});
	$('#PARAGH').click(function(){
		var str = "<textarea name='PARAGH_"+PARAGH_num+"'></textarea><br>";
		PARAGH_num++;
		$( "#form_holder" ).append( str );	
	});
	$('#CHECK').click(function(){
		var str = "<input type='checkbox' name='CHECK_"+CHECK_num+"'><br>";
		CHECK_num++;
		$( "#form_holder" ).append( str );	
	});
	$('#MCHOICE').click(function(){
		var str = "<select name='MCHOICE_"+MCHOICE_num+"'><br>";
		MCHOICE_num++;
		$( "#form_holder" ).append( str );	
	});
	$('#DROPDN').click(function(){
		var str = "<select name='DROPDN_"+DROPDN_num+"'><br>";
		DROPDN_num++;
		$( "#form_holder" ).append( str );	
	});

		
   });
  </script>
</head>
<body>
 
<div id="products">
  <h1 class="ui-widget-header">Form builder</h1>
  <div id="catalog">
    <h2><a href="#">Fields</a></h2>
    <div>
      <ul>
        <li ><input type="button" id = "SLT" value="Single line text"></li>
        <li ><input type="button" id = "NUM" value="Number"></li>
        <li ><input type="button" id = "PARAGH" value="Paragraph text"></li>
	<li ><input type="button" id = "CHECK" value="Checkboxes"></li>
	<li ><input type="button" id = "MCHOICE" value="Multiple choice"></li>
	<li ><input type="button" id = "DROPDN" value="Dropdown"></li>
      </ul>
    </div>
	
     </div>
</div>
 
<div id="form_holder" style="float:left">
</div> 
 <br>
<input type="button" id="send_json" value="Send json" >
</body>
</html>