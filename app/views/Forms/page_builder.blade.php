@extends('../layout')
@section('content')
<style>
.rad {
	text-align:center;
}
</style>

<script type="text/javascript" src="assets/js/page_builder.js"></script>
<div class="container">
<section id="page_builder_header">
  <div class="page-header">
	<h1>Page Builder</h1>
  </div>
<section id="settings">

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">1. Select template view</h3>
  </div>
  <div class="panel-body">
	<div class="row">
		<div class="col-md-3 rad">
			<input type="radio" id="view_type_1" name="view_type" value="3_col_view"> 
			<img src="assets/images/3_column_view.jpg" alt="..." class="img-rounded"><br><br>
			<span>3 column view</span>
		</div>
		<div class="col-md-3 rad">
			<input type="radio" id="view_type_2" name="view_type" value="2_col_left_view"> 
			<img src="assets/images/2_column_left_view.jpg" alt=" " class="img-rounded"><br><br>
			<span> 2 column view with left sidebar</span>
		</div>
		<div class="col-md-3 rad">
			<input type="radio" id="view_type_3" name="view_type" value="2_col_right_view"> 
			<img src="assets/images/2_column_right_view.jpg" alt="..." class="img-rounded"><br><br>
			<span> 2 column view with right sidebar</span>
		</div>
		<div class="col-md-3 rad"></div>
		
	</div>
		
  </div>
   	
	
</div>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">2. Select form</h3>
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
		<div class="col-md-3 radio"></div>
		
	</div>
		
  </div>
   	
	
</div>


<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">3. Select form data</h3>
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
		<div class="col-md-3 radio"></div>
		
	</div>
		
  </div>
   	
	
</div>
<div id="something"></div>


</section>
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
					<p> Currently, there is no form available !</p>
					@else
					<div class="table-responsive">
						<table class="table">
							<thead>
							<tr>
							<td></td>					
							<th>Form name</th>
							<th>Form description</th>
							
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
  <div class="modal-dialog">
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
								<option id="{{$form->form_id}}">{{$form->form_name }}</option>
								@endforeach
				
								</select>
							<input type="button" id="select_form" value="Select form" class="btn btn-success">
							<div id="form_data_display"></div>
						
						@endif
					






      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="1select_form_save_">Select forms</button>
      </div>
    </div>
  </div>




</section>




















<section id="generate_page_contents">
<button type="button" class="btn btn-success" id="build_page">Build a page</button>
</section>
</div>
@stop

