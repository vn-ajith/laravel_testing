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
  
<script src="assets/js/save_form_options.js" type="text/javascript"></script>
<script src="assets/js/jquery.validate.js" type="text/javascript"></script>
</head>
<div>
 
<div id="form_builder" class="panel panel-default">
  <h1 class="">Form builder</h1>
  <h2><input type="button" id="form_set" value="Form settings" class="btn btn-info"  ></h2>
    <h2>Fields</h2>
	{{ HTML::ul($errors->all(), array('class'=>'alert alert-danger'))}}
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
<form id="form_holder">
	
</form> 


<?php
require_once('assets/html/MAIN_modal.html');

?>
<div id="modal_holder">
</div>

<br>
<div id='error_holder'></div>
<input type="button" id="save_form_to_db" value="Save form" class="btn btn-success">

<!--  <img src="{{asset('assets/images/fanssignupsplash.png')}}"> -->
 <br>
<!-- <input type="button" id="send_json" value="Send json" > -->
</body>
</html>