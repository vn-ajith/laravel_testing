@extends('../layout')
@section('content')
<style>
.form-control {
	width:50%;
}
</style>
<?php
$fields = $form['desc_order']  ;

?>
<script type="text/javascript" src="../assets/js/save_form_data.js"></script>
<div class="container">

<form role="form" id="form">
	
	<input type="hidden" id="form_id" value="{{$form['form_id']}}">	
	<h1 id="form_name">{{$form['form_name']}}</h1>
	<h3>{{$form['form_desc']}}</h3>
	

	<p>* fields are required</p>

	@foreach ($fields as $key=>$field)
	<?php
		$index =strpos($key,'_');
		$name = substr($key,0,$index);
		
		$other_values = explode(',',$field->other_values);
		$x= array_pop($other_values);
		$number = 1;
		$label = $field->label;
		
		if($field->req_field==1)
		{
		$label = $label.' *';
		}
// 		echo '<pre>';
// 		print_r($other_values);
// 		echo '</pre>';
   	 ?>	
	@if($name=='SLT' or $name == 'NUM' )
	
		<div class="form-group">
			<label for="{{$key}}" id="{{$key.'_label'}}">{{$label}}</label>
			
			<input type="hidden" id="{{$key.'_required'}}" value="{{$field->req_field}}" >
			
			<input type="text" class="form-control {{$field->css_class_name}}" id="{{$key}}" name='{{$key}}' value='{{$field->default_value}}'>
			<div id="{{$key.'_error'}}" class='alert alert-danger' style="width:50%"></div>
		</div>
	@elseif($name == 'PARAGH')
		<div class="form-group">
			
			<input type="hidden" id="{{$key.'_required'}}" value="{{$field->req_field}}" >

			<label for="{{$key}}" id="{{$key.'_label'}}">{{$label}}</label>
			<textarea class="form-control {{$field->css_class_name}}" name='{{$key}}' id='{{$key}}' rows="3">{{$field->default_value}}</textarea>
			<div id="{{$key.'_error'}}" class='alert alert-danger' style="width:50%"></div>
		</div>
	@elseif($name == 'CHECK')
		
		
		<input type="hidden" id="{{$key.'_required'}}" value="{{$field->req_field}}" >
		
		<label for='{{$key}}' id="{{$key.'_label'}}">{{$label}}</label><br>
		@if(count($other_values)>0)
		
			<div class="checkbox">	
				<input type="checkbox" name="{{$key}}" id="{{$key.'_'.$number}}" class='{{$field->css_class_name}}' value="{{$field->default_value}}">
				{{$field->default_value}}
			</div>
			@foreach ($other_values as $other)
			<?php $number++; ?>
			<div class="checkbox">
			
				<input type="checkbox" name="{{$key}}" id="{{$key.'_'.$number}}" class='{{$field->css_class_name}}' value="{{$other}}">
				{{$other}}
			</div>
			@endforeach
		@else
			<div class="checkbox">
				<input type="checkbox" name="{{$key}}" id="{{$key}}" class='{{$field->css_class_name}}' value="{{$field->default_value}}">
				{{$field->default_value}}
			</div>
					
			
		
		@endif
			<div id="{{$key.'_error'}}" class='alert alert-danger' style="width:50%"></div>
	@elseif($name == 'DROPDN')
		
		
			<input type="hidden" id="{{$key.'_required'}}" value="{{$field->req_field}}" >			
		<label for='{{$key}}' id="{{$key.'_label'}}">{{$label}}</label><br>
		<select class="form-control {{$field->css_class_name}}" name="{{$key}}" id="{{$key}}" >
  			<option value="{{$field->default_value}}">{{$field->default_value}}</option>
		@if(count($other_values)>0)
			@foreach ($other_values as $other)
				<option value="{{$other}}">{{$other}}</option>
			@endforeach
		@endif
		</select>
		<div id="{{$key.'_error'}}" class='alert alert-danger' style="width:50%"></div>
	@elseif($name == 'MCHOICE')
		
		<input type="hidden" id="{{$key.'_required'}}" value="{{$field->req_field}}" >
		<label for='{{$key}}' id="{{$key.'_label'}}">{{$label}}</label><br>
		<select class="form-control {{$field->css_class_name}}" name="{{$key}}" id="{{$key}}" multiple="true" >
		
			
  			<option value="{{$field->default_value}}">{{$field->default_value}}</option>
		@if(count($other_values)>0)
			@foreach ($other_values as $other)
				<option value="{{$other}}">{{$other}}</option>
			@endforeach
		@endif
		</select>	
		<div id="{{$key.'_error'}}" class='alert alert-danger' style="width:50%"></div>

		
	@endif
	@endforeach
<br>
<input type="button" class="btn btn-success" value="Save" id="save_form_data">
</form>

</div>
@stop

