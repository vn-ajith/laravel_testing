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


<?php
require_once('assets/html/modal1.html');
require_once('assets/html/modal2.html');
require_once('assets/html/modal3.html');
require_once('assets/html/modal4.html');
?>



<!--  <img src="{{asset('assets/images/fanssignupsplash.png')}}"> -->
 <br>
<!-- <input type="button" id="send_json" value="Send json" > -->
</body>
</html>