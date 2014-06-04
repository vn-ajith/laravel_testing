@extends('../layout')
@section('content')
  
  <style>
  h1 { padding: .2em; margin: 0; }
	#form_builder{
		padding-left:15px;
	}
  .panel-body {
		float:left;
		margin-right:50px;
	}	
	#form_holder{
		float:left;
		margin-right:50px;
	}
	.form_button{
		width:150px;
		margin-left:50px;
		text-align:center;
		margin-top: 5px;
	}   
	.set_button{
		width:100px;
		margin-left:10px;
		text-align:center;
		
	}
	.del_button{
		width:100px;
		margin-left:10px;
		text-align:center;
		clear:both;
	
	}
	.field_c{
		margin-right:36%;
		float:left;
	}
	.field{
		width:150px;
	}
	.p_wid{
	min-width:386px !important;
	}
	#navigation_header{
		
		padding-bottom:15px;
		background-color:#f8f8f8;
		margin-bottom:20px;
	}
	.navbar-default {
		border-color:#f8f8f8;
	}
	.navbar{
		margin-bottom:0px;
	}
  
	
  
  
  
  </style>
  
<script src="assets/js/save_form_options.js" type="text/javascript"></script>
<div class="col-md-12" id="navigation_header">
	<div class="container">
		<nav class="navbar navbar-default" role="navigation">
			<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
		
		<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav" style="float:right;">
						<li><a href="{{action('UsersController@dashboard')}}">Dashboard</a></li>
						<li class="active"><a href="{{action('FormsController@render_form_creator')}}">Form builder</a></li>	
						<li><a href="{{action('ListBuilderController@list_builder')}}">List builder</a></li>	
						<li><a href="{{action('PageBuilderController@page_build')}}">Page builder</a></li>
						<li><a href="{{action('UsersController@logout')}}">Sign out</a></li>
					</ul>
		 		</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>
	</div>
</div>

<div>
 
<div id="form_builder" class="panel panel-default" style="padding-top:10px;">
  <h1 class="">Form builder</h1>
  <h2><input type="button" id="form_set" value="Form settings" class="btn btn-info"  ></h2>
    <h2>Fields</h2>
	{{ HTML::ul($errors->all(), array('class'=>'alert alert-danger'))}}
    <div class="panel-body">
      
        <input type="button" id = "SLT" value="Single line text" class="btn btn-primary form_button"><br>
        <input type="button" id = "NUM" value="Number" class="btn btn-primary form_button"><br>
        <input type="button" id = "PARAGH" value="Paragraph text" class="btn btn-primary form_button"><br>
	<input type="button" id = "CHECK" value="Checkboxes" class="btn btn-primary form_button"><br>
	<input type="button" id = "MCHOICE" value="Multiple choice" class="btn btn-primary form_button"><br>
	<input type="button" id = "DROPDN" value="Dropdown" class="btn btn-primary form_button"><br>
      
    </div>

	
  
</div>
<div id="form_holder">
	
</div> 


<?php
require_once('assets/html/MAIN_modal.html');

?>
<div id="modal_holder">
</div>

<br>
<div id='error_holder'></div>
<input type="button" id="save_form_to_db" value="Save form" class="btn btn-success">

<!--  <img src="{{asset('assets/images/fanssignupsplash.png')}}"> -->

@stop