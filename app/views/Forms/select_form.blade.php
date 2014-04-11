@extends('../layout')
@section('content')
  
<section class="header section-padding">
<div class="background">&nbsp;</div>
<div class="container">
<div class="header-text">
<h1>Forms available</h1>
</div>
</div>
</section>


<div class="container">
<section class="section-padding">
<div class="jumbotron text-center">

	
           
        

	<div class="panel panel-default">
	<div class="panel-heading">
	<h1><span class="grey">Forms</span></h1>
	</div>
	@if ($forms->isEmpty())
	<p> Currently, there is no form available !</p>
	@else
	<table class="table">
	<thead>
	<tr>
	
	<th>Form name</th>
	<th>Form description</th>
	<th>Form url</th>
	</tr>
	</thead>
	<tbody>
	@foreach($forms as $form)
	<tr>
	
	<td>{{$form->form_name }}</td>
	<td>{{$form->form_desc}}</td>
	<td>{{$form->form_url}}</td>
	<td><a href="{{ action('FormsController@render_form', $form->form_id) }}" class="btn btn-info">Edit</a></td>>
	</tr>
	@endforeach
	</tbody>
	</table>
	@endif
	</div>
	
	
	
	


</div>
</section>
</div>
@stop