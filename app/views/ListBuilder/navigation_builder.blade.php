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

</style>
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