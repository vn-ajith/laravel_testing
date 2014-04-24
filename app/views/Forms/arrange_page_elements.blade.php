@extends('../layout')
@section('content')
<?php
$view_type = $page->view_type;
$i=1;

$form = Form_config::findOrFail(4);
// var_dump($form->form_name);
// echo 'hi';
$f = array('form_name' => $form->form_name,
					'form_desc' => $form->form_desc,
					'form_url'  => $form->form_url,
					'form_id'   => $form->form_id,
					'desc_order'=>json_decode($form->desc_order),true);

$form = Form_config::findOrFail(3);
// var_dump($form->form_name);
// echo 'hi';
$g = array('form_name' => $form->form_name,
					'form_desc' => $form->form_desc,
					'form_url'  => $form->form_url,
					'form_id'   => $form->form_id,
					'desc_order'=>json_decode($form->desc_order),true);

  ?>

<style>
div {
text-align:center;
}
.box {
	border-color:grey;
	border:1px solid;
	margin:5px;
}
</style>
<script type="text/javascript" src="../assets/js/page_arrange.js"></script>
<script type="text/javascript" src="../assets/js/save_form_data.js"></script>
<div class="container">
<div class="row">
<div class="col-md-12"></div>
<div class="col-md-12"></div>
<div class="col-md-12"></div>
<div class="col-md-12"></div>
<div class="col-md-12"></div>
<div class="col-md-12"><h1>heading</h1></div>
<div class="col-md-12"></div>
<div class="col-md-12"></div>
<div class="col-md-12"></div>
<div class="col-md-12"></div>

<div class="col-md-12">
@if($view_type=='3_col_view')

	<div class="col-md-3" id="left_3_column">
	<h3>Left side bar</h3>
		@foreach($left_side_bar as $left)	
			<div id="box{{$i++}}" class="box">
				<p>Form id:{{$left["form_id"]}}</p>
				<p>{{$left["form_name"]}}</p>
				@if(isset($left["e_id"])) 
					<p>{{$left["e_id"]}}</p>
				@endif
			</div>
		@endforeach
	
	</div>
	<div class="col-md-6" id="main_3_column">
	<h3>Main</h3>
		@foreach($main_content as $main)	
			<div id="box{{$i++}}" class="box">
				<p>{{$main["form_id"]}}</p>
				<p>{{$main["form_name"]}}</p>
				@if(isset($main["e_id"])) 
					<p>{{$main["e_id"]}}</p>
				@endif
			</div>
		@endforeach
	</div>
	<div class="col-md-3" id="right_3_column">
	<h3>Right side bar </h3>
		@foreach($right_side_bar as $right)	
			<div id="box{{$i++}}" class="box">
				<p>{{$right["form_id"]}}</p>
				<p>{{$right["form_name"]}}</p>
				@if(isset($right["e_id"])) 
					<p>{{$right["e_id"]}}</p>
				@endif
			</div>
		@endforeach
	</div>
	
	
@elseif($view_type=='2_col_right_view')
	
	<div class="col-md-9" id="main_2_column_right">
	<h3>Main</h3>
		@foreach($main_content as $main)	
			<div id="box{{$i++}}" class="box">
				<p>{{$main["form_id"]}}</p>
				<p>{{$main["form_name"]}}</p>
				@if(isset($main["e_id"])) 
					<p>{{$main["e_id"]}}</p>
				@endif
			</div>
		@endforeach
	</div>
	<div class="col-md-3" id="right_2_column_right">
	<h3>Right side bar </h3>
		
		@foreach($right_side_bar as $right)	
			<div id="box{{$i++}}" class="box">
				<p>{{$right["form_id"]}}</p>
				<p>{{$right["form_name"]}}</p>
				@if(isset($right["e_id"])) 
					<p>{{$right["e_id"]}}</p>
				@endif
			</div>
		@endforeach
	
	</div>
@elseif($view_type=='2_col_left_view')
	
	<div class="col-md-3" id="left_2_column_left">
	<h3>Left side bar</h3>
		@foreach($left_side_bar as $left)	
			<div id="box{{$i++}}" class="box">
				<p>{{$left["form_id"]}}</p>
				<p>{{$left["form_name"]}}</p>
				@if(isset($left["e_id"])) 
					<p>{{$left["e_id"]}}</p>
				@endif
			</div>
		@endforeach
	</div>
	<div class="col-md-9" id="main_2_column_left">
	<h3>Main</h3>
		@foreach($main_content as $main)	
			<div id="box{{$i++}}" class="box">
				<p>{{$main["form_id"]}}</p>
				<p>{{$main["form_name"]}}</p>
				@if(isset($main["e_id"])) 
					<p>{{$main["e_id"]}}</p>
				@endif
			</div>
		@endforeach
	</div>

@endif  
</div>

  
<div class="col-md-3"  id="left">
<div class="box">@include('Forms.render_form', array('form'=>$f))</div>
<div class="box">@include('Forms.render_form', array('form'=>$g))</div>
</div>
<div class="col-md-6"></div>
<div class="col-md-3" >

</div>

</div>
</div>
@stop