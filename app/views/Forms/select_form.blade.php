@extends('../layout')
@section('content')
  <link rel="stylesheet" href="assets/css/superhero_bootstrap_theme.css" > 
<style>
#forms_table tr td{
	padding-left:5px;
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
body{
	background-color:#f8f8f8;
}
h1{
text-align:center;
}
</style>
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
						<li><a href="{{action('FormsController@render_form_creator')}}">Form builder</a></li>	
						<li class="active"><a href="{{action('FormsController@select_form')}}">Forms available</a></li>
						<li><a href="{{action('ListBuilderController@list_builder')}}">List builder</a></li>	
						<li><a href="{{action('PageBuilderController@page_build')}}">Page builder</a></li>
						<li><a href="{{action('UsersController@logout')}}">Sign out</a></li>
					</ul>
		 		</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>
	</div>
</div>

<div class="container">
					
	<h1>Forms</h1>
					
	
					
	@if ($forms->isEmpty())
	<p> Currently, there is no form available !</p>
	@else
	<table class="table table-striped table-hover" id="forms_table">
		<thead>
			<tr>
				<th>Form name</th>
				<th>Form description</th>
				
			</tr>
		</thead>
					
		<tbody>
			@foreach($forms as $form)
				<tr class="warning">
								
					<td>{{$form->form_name }}</td>
					<td>{{$form->form_desc}}</td>
								
					<td><a href="{{action('FormsController@render_form', $form->form_id) }}" class="btn btn-info">Add data</a></td>
				</tr>
			@endforeach
						
		</tbody>
	</table> 
	@endif
</div>
		
		
		
@stop