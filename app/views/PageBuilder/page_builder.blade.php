@extends('../layout')
@section('content')
<style>
.rad {
	text-align:center;
}

#generate_page_contents > div {
    margin-bottom: 15px;
    padding: 7px;
}
#save_page {
    margin-left: 50%;
}
.form-group{
	width:50%;
}
#page_builder_header {
    margin-top: 10%;
}
#navigation_header{
		padding-top:15px;
		padding-bottom:15px;
		background-color:#f8f8f8;
		
	}
	.navbar-default {
		border-color:#f8f8f8;
	}
	.navbar{
		margin-bottom:0px;
	}

</style>

<script type="text/javascript" src="assets/js/page_builder.js"></script>
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
						<li><a href="{{action('ListBuilderController@list_builder')}}">List builder</a></li>	
						<li class="active"><a href="{{action('PageBuilderController@page_build')}}">Page builder</a></li>
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
			<h1>Page Builder</h1>
  		</div>
		<ul class="nav nav-tabs">
  			<li class="active" id='li_page_layout'><a href="#page_builder_page_layout" data-toggle="tab">Page layout</a></li>
  			<li><a href="#page_builder_layout_editor" id="li_layout_editor" data-toggle="tab">Layout editor</a></li>

		</ul>

<!-- Tab panes -->
		<div class="tab-content">
  			<div class="tab-pane active" id="page_builder_page_layout">



	
				<section id="settings">
			
					<div class="panel panel-default">
						<div class="panel-heading">
		    					<h3 class="panel-title">1. Page name</h3>
		  				</div>
		  				<div class="panel-body">
							<div class="form-group">
								<input type="text" class="form-control" id="page_name" placeholder="Enter a page name">
							</div>
					
						</div>
		
		  			</div>
		   	
	
		

					<div class="panel panel-default">
		  				<div class="panel-heading">
		    					<h3 class="panel-title">2. Select template view</h3>
		  				</div>
		  				<div class="panel-body">
							<div class="row">
								<div class="col-md-3 rad">
									<input type="radio" id="view_type_1" name="view_type" value="3_col_view"> 
									<img src="{{asset('assets/images/3_column_view.jpg')}}" alt="..." class="img-rounded"><br><br>
									<span>3 column view</span>
								</div>
								<div class="col-md-3 rad">
									<input type="radio" id="view_type_2" name="view_type" value="2_col_left_view"> 
									<img src="{{asset('assets/images/2_column_left_view.jpg')}}" alt=" " class="img-rounded"><br><br>
									<span> 2 column view with left sidebar</span>
								</div>
								<div class="col-md-3 rad">
									<input type="radio" id="view_type_3" name="view_type" value="2_col_right_view"> 
									<img src="{{asset('assets/images/2_column_right_view.jpg')}}" alt="..." class="img-rounded"><br><br>
									<span> 2 column view with right sidebar</span>
								</div>
								<div class="col-md-3 rad"></div>
						
							</div>
		
		  				</div>
		   	
	
					</div>

					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">3. Select form</h3>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-3 radio">
									<button class="btn btn-success" data-toggle="modal" data-target="#myModal">
									Form List
									</button>
			
								</div> 
								<div class="col-md-3 radio">
								</div>
								<div class="col-md-3 radio">
								</div>
								<div class="col-md-3 radio">
								</div>
					
							</div>
					
						</div>
						
				
					</div>


					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">4. Select form data</h3>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-3 radio">
									<button class="btn btn-success" data-toggle="modal" data-target="#myModal_2">
									Add Form data 
									</button>
			
								</div> 
								<div class="col-md-3 radio">
								</div>
								<div class="col-md-3 radio">
								</div>
								<div class="col-md-3 radio">
								</div>
						
							</div>
					
						</div>
						
				
					</div>
					
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">5. Select lists </h3>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-3 radio">
									<button class="btn btn-success" data-toggle="modal" data-target="#myModal_3">
									Add List  
									</button>
			
								</div> 
								<div class="col-md-3 radio">
								</div>
								<div class="col-md-3 radio">
								</div>
								<div class="col-md-3 radio">
								</div>
						
							</div>
					
						</div>
						
				
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">6</h3>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-3 radio">
									<div class="checkbox">  <label> <input type="checkbox" id="grid_list_view" value="1">Grid view /List view</label></div>
			
								</div> 
								<div class="col-md-3 radio">
								</div>
								<div class="col-md-3 radio">
								</div>
								<div class="col-md-3 radio">
								</div>
					
							</div>
					
						</div>
						
				
					</div>




				</section>	
				<section id="generate_page_contents">
		
					<div id ="place_generate_page_contents">
						<input type="button" class="btn btn-success" id="generate_layout" value="Generate layout">
					</div>
				</section>		
		
			</div>
			<div class="tab-pane" id="page_builder_layout_editor"></div>
		</div>	

		<input type="button" value="Save page"  id="save_page"  class="btn btn-primary">




<section id="modal">
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
		      		<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Select forms</h4>
		      		</div>
		      		<div class="modal-body">	
				
					
						<label > Select forms from the following </label>
							@if ($forms->isEmpty())
							<p> Currently, there are no forms available !</p>
							@else
							<div class="table-responsive">
								<table class="table">
									<thead>
									<tr>
									<td></td>					
									<th>Form name</th>
									<th>Form description</th>
									<th>Position</th>
									</tr>
									</thead>
									<tbody>
									@foreach($forms as $form)
									<tr>
									<td><input type="checkbox" id="{{$form->form_id}}" name="check" value="{{$form->form_name }}"  ></td>
									<td>{{$form->form_name }}</td>
									<td>{{$form->form_desc}}</td>
							
									<td>	
										<select id="position_{{$form->form_id}}">
				
				
										</select>
									</td>			
									</tr>
									@endforeach
									</tbody>
								</table>
								@endif
				</div>
		     	 </div>
		      	<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="select_form_save">Select forms</button>
		      	</div>
		</div>
	</div>




</section>





<section id="modal2_2">
	<div class="modal fade" id="myModal_2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  		<div class="modal-dialog" style="max-width:750px !important;">
    			<div class="modal-content">
      				<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        				<h4 class="modal-title" id="myModalLabel">Select forms data</h4>
      				</div>
      				<div class="modal-body">	
				
					        			
					<label>Select a form</label>
					@if ($forms->isEmpty())
					<p> Currently, there is no form available !</p>
					@else
					
							<select id="form_selector">
							@foreach ($forms as $form)
								<option id="{{$form->form_id}}" >{{$form->form_name }}</option>
								@endforeach
				
								</select>
							<input type="button" id="select_form" value="Select form" class="btn btn-success">
							<div id="form_data_display"></div>
							
						
						@endif
					

      				</div>
      				<div class="modal-footer">

				        <input type="button"  id="select_form_data" value="Add data " class="btn btn-success">
      				</div>
    			</div>
  		</div>

	</div>


</section>

<section id="modal2_3">
	<div class="modal fade" id="myModal_3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  		<div class="modal-dialog" style="max-width:750px !important;">
    			<div class="modal-content">
      				<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        				<h4 class="modal-title" id="myModalLabel">Select lists</h4>
      				</div>
      				<div class="modal-body">	
				
					        			
					<label > Select lists from the following </label>
							@if ($lists->isEmpty())
							<p> Currently, there are no lists available !</p>
							@else
							<div class="table-responsive">
								<table class="table">
									<thead>
									<tr>
									<td></td>					
									<th>List name</th>
									
									<th>Position</th>
									</tr>
									</thead>
									<tbody>
									@foreach($lists as $list)
									<tr>
									<td><input type="checkbox" id="{{$list->list_id}}" name="list_check" value="{{$list->list_name }}"  ></td>
									<td>{{$list->list_name }}</td>
									
							
									<td>	
										<select id="lists_position_{{$list->list_id}}">
				
				
										</select>
									</td>			
									</tr>
									@endforeach
									</tbody>
								</table>
								@endif
					

      				</div>
      				<div class="modal-footer">

				        <input type="button"  id="select_list" value="Select list " class="btn btn-success">
      				</div>
    			</div>
  		</div>

	</div>


</section>





</div>
@stop
