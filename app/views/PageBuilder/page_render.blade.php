@extends("layout")
@section("content")

<?php
	$view_type =  $page->view_type;
	
	
	ListBuilderController::list_maker(4);
		
?>

<div class="container">
	<div class="col-md-12" id="header">
		@if($header!=NULL)
			@foreach($header as $h)
				{{$h}}
			@endforeach
		@endif
	</div>
	@if($view_type =="2_col_left_view")
		<div class="col-md-3">
			@if($left!=NULL)
				
				@foreach($left as $l)
					{{$l}}
				@endforeach
			@endif
		</div>
		<div class="col-md-9">
			@if($main!=NULL)
				@foreach($main as $m)
					{{$m}}
				@endforeach
			@endif
		</div>
	@endif	
	@if($view_type =="3_col_view")
		<div class="col-md-3">
			@if($left!=NULL)
				
				@foreach($left as $l)
					{{$l}}
				@endforeach
			@endif
		</div>
		<div class="col-md-6">
			@if($main!=NULL)
				@foreach($main as $m)
					{{$m}}
				@endforeach
			@endif
		</div>
		<div class="col-md-3">
			@if($right!=NULL)
				@foreach($right as $r)
					{{$r}}
				@endforeach
			@endif
		</div>
	@endif	
	@if($view_type =="2_col_right_view")
		<div class="col-md-9">
			@if($main!=NULL)
				@foreach($main as $m)
					{{$m}}
				@endforeach
			@endif
		</div>
		<div class="col-md-3">
			@if($right!=NULL)
				@foreach($right as $r)
					{{$r}}
				@endforeach
			@endif
		</div>
	@endif	
	<div class="col-md-12" id="footer">
		@if($footer!=NULL)
			@foreach($footer as $f)
				{{$f}}
			@endforeach
		@endif
	</div>
</div>

@stop