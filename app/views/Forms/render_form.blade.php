@extends('../layout')
@section('content')
<?php
$fields = $form['desc_order']  ;

?>
<div class="container">
<form role="form">
		
	<h1>{{$form['form_name']}}</h1>
	<h3>{{$form['form_desc']}}</h3>


	@foreach ($fields as $key=>$field)
	<?php
		$index =strpos($key,'_');
		$name = substr($key,0,$index);
		
		$other_values = explode(',',$field->other_values);
		$x= array_pop($other_values);
		$number = 1;
   	 ?>	
	@if($name=='SLT' or $name == 'NUM' )
	
		<div class="form-group">
			<label for="{{$key}}">{{$field->label}}</label>
			<input type="text" class="form-control {{$field->css_class_name}}" id="{{$key}}" name='{{$key}}' value='{{$field->default_value}}'>
		</div>
	@elseif($name == 'PARAGH')
		<div class="form-group">
			<label for="{{$key}}">{{$field->label}}</label>
			<textarea class="form-control {{$field->css_class_name}}" name='{{$key}}' id='{{$key}}' rows="3">{{$field->default_value}}</textarea>
		</div>
	@elseif($name == 'CHECK')
		<label for='{{$key}}'>{{$field->label}}</label><br>
		@if(count($other_values)>0)
		
			<div class="checkbox">	
				<input type="checkbox" name="{{$key}}[]" id="{{$key.'_'.$number}}" class='{{$field->css_class_name}}' value="{{$field->default_value}}">
				{{$field->default_value}}
			</div>
			@foreach ($other_values as $other)
			<?php $number++; ?>
			<div class="checkbox">
			
				<input type="checkbox" name="{{$key}}[]" id="{{$key.'_'.$number}}" class='{{$field->css_class_name}}' value="{{$other}}">
				{{$other}}
			</div>
			@endforeach
		@else
			<div class="checkbox">
				<input type="checkbox" name="{{$key}}" id="{{$key}}" class='{{$field->css_class_name}}' value="{{$field->default_value}}">
				{{$field->default_value}}
			</div>
					
			
		
		@endif
	@elseif($name == 'DROPDN')
		{{$field->other_values}}
		<select class="form-control">
  			<option>1</option>
  			<option>2</option>
  			<option>3</option>
  			<option>4</option>
  			<option>5</option>
		</select>
	@endif
	@endforeach
<button type="submit" class="btn btn-default">Submit</button>
</form>

</div>
@stop

