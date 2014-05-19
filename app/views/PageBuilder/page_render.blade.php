@extends("layout")
@section("content")
<script src="../assets/js/jquery-1.9.1.js" type="text/javascript"></script>
  <script src="../assets/js/jquery-ui.js" type="text/javascript"></script>
<!--   <link rel="stylesheet" href="../assets/css/bootstrap.min.css"> -->
<!--   <script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>	 -->

	
	<link rel="stylesheet" href="../assets/css/menu_boot.css">
	<script src="../assets/js/menu_boot.js" type="text/javascript"></script>

<?php
	$view_type =  $page->view_type;
	
	
	ListBuilderController::do_something(6);
		
?>


<div class="container">
	<div class="col-md-12" id="header">
		@if($header!=NULL)
			@foreach($header as $h)
				<?php 
				$forms = PageBuilderController::make_component($h);
				
				 ?>
 				
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