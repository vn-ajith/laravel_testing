@extends("layout")
@section("content")

<?php
	$view_type =  $page->view_type;
	$box_order = json_decode($page->box_order,true);
	if(isset($box_order["header"]))
	{
		$header = $box_order["header"];
	}
	if(isset($box_order["footer"]))
	{
		$footer = $box_order["footer"];
	}
	if(isset($box_order["left"]))
	{
		$left = $box_order["left"];
	}
	if(isset($box_order["main"]))
	{
		$main = $box_order["main"];
	}
	if(isset($box_order["right"]))
	{
		$right = $box_order["right"];
	}
	
		
?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="{{action('UsersController@dashboard')}}">Dashboard</a></li>
            <li><a href="{{action('PageBuilderController@page_build')}}">Page builder</a></li>
            <li><a href="{{action('UsersController@logout')}}">Sign out</a></li>
            <li><a href="#">Help</a></li>
          </ul>
          
        </div>
      </div>
</nav>
<div class="container">
	<div class="col-md-12" id="header">
		@foreach($header as $h)
			{{$h}}
		@endforeach
	</div>
	@if($view_type =="2_col_left_view")
		<div class="col-md-3">
			@foreach($left as $l)
				{{$l}}
			@endforeach
		</div>
		<div class="col-md-9">
			@foreach($main as $m)
				{{$m}}
			@endforeach
		</div>
	@endif	
	@if($view_type =="3_col_view")
		<div class="col-md-3">
			@foreach($left as $l)
				{{$l}}
			@endforeach
		</div>
		<div class="col-md-6">
			@foreach($main as $m)
				{{$m}}
			@endforeach
		</div>
		<div class="col-md-3">
			@foreach($right as $r)
				{{$r}}
			@endforeach
		</div>
	@endif	
	@if($view_type =="2_col_right_view")
		<div class="col-md-9">
			@foreach($main as $m)
				{{$m}}
			@endforeach
		</div>
		<div class="col-md-3">
			@foreach($right as $r)
				{{$r}}
			@endforeach
		</div>
	@endif	
	<div class="col-md-12" id="footer">
		@foreach($footer as $f)
			{{$f}}
		@endforeach
	</div>
</div>

@stop