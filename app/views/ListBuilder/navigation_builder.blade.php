@extends('../layout')
@section('content')
<script type="text/javascript" src="assets/js/nav_builder.js"></script>
<style>
.col-md-2{
	border-right:1px grey dashed;
}
li {


	border-radius:7px;	
	padding:10px;
}
.edit{
	float:right;
}
.box{
	padding-left:25px;	
	font-size:18px;
}
.task{
	padding:4px;
}
#save_nav{
	margin-left:30%;
	margin-top:6%;

}
.box_test {
	background-color: #D3D3D3;
	border: 1px solid #D3D3D3;
	border-radius: 4px;
	padding:3px
	
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
						<li class="active"><a href="{{action('ListBuilderController@list_builder')}}">List builder</a></li>	
						<li><a href="{{action('PageBuilderController@page_build')}}">Page builder</a></li>
						<li><a href="{{action('UsersController@logout')}}">Sign out</a></li>
					</ul>
		 		</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>
	</div>
</div>
<div class="container">

	<section id="page_builder_header">
   		<div class="page-header">
			<h1>List Builder</h1>
		</div>
	</section>


	<div class="col-md-12">
		<div class="col-md-2">
			<div class="form-group">
				<input type="text" id="list_name" placeholder="Enter list name"  class="form-control">
			</div>
		</div>

		<div class="col-md-2">
			<input type="button" id="add_menu" value="Add a menu" class="btn btn-primary">
		</div>
		<div class="col-md-8">
			<div id="menu_holder">

			</div>
		</div>
	</div>

	<div class="col-md-12">
		<input type="button" class="btn btn-success" value="Save navigation bar" id="save_nav">
	</div>

	<div id="modal_holder">
		<div class="modal fade" id="myModal_add_menu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">

						<h4 class="modal-title" id="myModalLabel">Add a menu</h4>
					</div>
					<div class="modal-body">
						<div id="settings">
							<div class="form-group">
								<label for="form_name">Title</label>
								<input type="text" class="form-control" id="nav_title" placeholder="Enter menu title">
								<div id="nav_title_error" ></div>	
							</div>


							<div class="form-group">
								<label for="form_url">URL</label>
								<input type="text" class="form-control" id="nav_url" placeholder="Enter menu URL">
								<div id="nav_url_error" ></div>	
							</div>


						</div>


					</div>


					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" id="add_new_menu">Save changes</button>
					</div>
				</div>
			</div>
		</div> <!-- end of modal for new main menu -->


<!-- end of modal for new sub menu -->
		<div class="modal fade" id="myModal_add_sub_menu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">

						<h4 class="modal-title" id="myModalLabel_2">Add a sub menu</h4>
					</div>
					<div class="modal-body">
						<div id="settings">
							<div class="form-group">
								<input type="hidden" value="" id="menu">
								<label for="form_name">Title</label>
								<input type="text" class="form-control" id="nav_sub_title" placeholder="Enter menu title">
								<div id="nav_sub_title_error" ></div>	
							</div>
	

							<div class="form-group">
								<label for="form_url">URL</label>
								<input type="text" class="form-control" id="nav_sub_url" placeholder="Enter menu URL">
								<div id="nav_sub_url_error" ></div>	
							</div>


						</div>


					</div>


					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" id="add_new_sub_menu">Save changes</button>
					</div>
				</div>
			</div>
		</div>	
	</div>

</div>
@stop