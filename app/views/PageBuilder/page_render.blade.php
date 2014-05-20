@extends("layout_page_render")
@section("content")
<style>
.box{
padding:5px;
border:1px solid black;
}
</style>

	
	
<?php
	$view_type =  $page->view_type;
	
	
	ListBuilderController::list_maker(6);
		
?>


<div class="container">
	<div class="row">
		<div class="col-md-12 box" id="header">
			@if($header!=NULL)
				@foreach($header as $h)
					<?php 
					$forms = PageBuilderController::make_component($h);
				
				 	?>
 				
				@endforeach
			@endif
		</div>
	</div>
	@if($view_type =="2_col_left_view")
		<div class="row">
			<div class="col-md-3 box">
				@if($left!=NULL)
					
					@foreach($left as $l)
						{{$l}}
					@endforeach
				@endif
			</div>
			<div class="col-md-9 box">
				@if($main!=NULL)
					@foreach($main as $m)
						{{$m}}
					@endforeach
				@endif
			</div>
		</div>
	@endif	
	@if($view_type =="3_col_view")
		<div class="row">
			<div class="col-md-3 box">
				@if($left!=NULL)
					
					@foreach($left as $l)
						{{$l}}
					@endforeach
				@endif
			</div>
			<div class="col-md-6 box">
				@if($main!=NULL)
					@foreach($main as $m)
						{{$m}}
					@endforeach
				@endif
			</div>
			<div class="col-md-3 box">
				@if($right!=NULL)
					@foreach($right as $r)
						{{$r}}
					@endforeach
				@endif
			</div>
		</div>
	@endif	
	@if($view_type =="2_col_right_view")
		<div class="row">
			<div class="col-md-9 box">
				@if($main!=NULL)
					@foreach($main as $m)
						{{$m}}
					@endforeach
				@endif
			</div>
			<div class="col-md-3 box">
				@if($right!=NULL)
					@foreach($right as $r)
						{{$r}}
					@endforeach
				@endif
			</div>
		</div>
	@endif	
	<div class="row">
		<div class="col-md-12 box" id="footer">
			@if($footer!=NULL)
				@foreach($footer as $f)
					{{$f}}
				@endforeach
			@endif
		</div>
	</div>
</div>

@stop