@extends("layout_page_render")
@section("content")


	
	
<?php
	$view_type =  $page->view_type;
		
?>


<div class="container">
	<div class="row">
		<div class="col-md-12 box" id="header">
			@if($header!=NULL)
				@foreach($header as $h)
						<?php 
							$items = explode("#",$h) ;
							$item = $items[0];
							$num = $items[1];
							if($num==0)
							{
							$forms = PageBuilderController::make_component($h);
							}
							else 
							{
								if($items[0]!="list")
								{
									if($form_data!=NULL)
									{
										$field_options = $form_data[$item]["field_options"];
										$css_class_name = $form_data[$item]["css_class_name"];
											
									}
								}
								else
								{
									$field_options = NULL;
									$css_class_name = NULL;
								}
								PageBuilderController::make_component($h,$field_options,$css_class_name);
							}
					?>
<!-- 					{{$h}} -->
				@endforeach
			@endif
		</div>
	</div>
	@if($view_type =="2_col_left_view")
		<div class="row">
			<div class="col-md-3 box">
				@if($left!=NULL)
					
					@foreach($left as $l)
							<?php 
							$items = explode("#",$l) ;
							$item = $items[0];
							$num = $items[1];
							if($num==0)
							{
							$forms = PageBuilderController::make_component($l);
							}
							else 
							{
								if($items[0]!="list")
								{
									if($form_data!=NULL)
									{
										$field_options = $form_data[$item]["field_options"];
										$css_class_name = $form_data[$item]["css_class_name"];
											
									}
								}
								else
								{
									$field_options = NULL;
									$css_class_name = NULL;
								}
								PageBuilderController::make_component($l,$field_options,$css_class_name);
							}
					?>
<!-- 					{{$l}} -->
					@endforeach
				@endif
			</div>
			<div class="col-md-9 box">
				@if($main!=NULL)
					@foreach($main as $m)
							<?php 
							$items = explode("#",$m) ;
							$item = $items[0];
							$num = $items[1];
							if($num==0)
							{
							$forms = PageBuilderController::make_component($m);
							}
							else 
							{
								if($items[0]!="list")
								{
									if($form_data!=NULL)
									{
										$field_options = $form_data[$item]["field_options"];
										$css_class_name = $form_data[$item]["css_class_name"];
											
									}
								}
								else
								{
									$field_options = NULL;
									$css_class_name = NULL;
								}
								PageBuilderController::make_component($m,$field_options,$css_class_name);
							}
					?>
<!-- 					{{$m}} -->
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
							<?php 
							$items = explode("#",$l) ;
							$item = $items[0];
							$num = $items[1];
							if($num==0)
							{
							$forms = PageBuilderController::make_component($l);
							}
							else 
							{
								if($items[0]!="list")
								{
									if($form_data!=NULL)
									{
										$field_options = $form_data[$item]["field_options"];
										$css_class_name = $form_data[$item]["css_class_name"];
											
									}
								}
								else
								{
									$field_options = NULL;
									$css_class_name = NULL;
								}
								PageBuilderController::make_component($l,$field_options,$css_class_name);
							}
					?>
<!-- 					{{$l}} -->
					@endforeach
				@endif
			</div>
			<div class="col-md-6 box">
				@if($main!=NULL)
					@foreach($main as $m)
						<?php 
							$items = explode("#",$m) ;
							$item = $items[0];
							$num = $items[1];
							if($num==0)
							{
							$forms = PageBuilderController::make_component($m);
							}
							else 
							{
								if($items[0]!="list")
								{
									if($form_data!=NULL)
									{
										$field_options = $form_data[$item]["field_options"];
										$css_class_name = $form_data[$item]["css_class_name"];
											
									}
								}
								else
								{
									$field_options = NULL;
									$css_class_name = NULL;
								}
								PageBuilderController::make_component($m,$field_options,$css_class_name);
							}
					?>
<!-- 					{{$m}} -->
					@endforeach
				@endif
			</div>
			<div class="col-md-3 box">
				@if($right!=NULL)
					@foreach($right as $r)
							<?php 
							$items = explode("#",$r) ;
							$item = $items[0];
							$num = $items[1];
							if($num==0)
							{
							$forms = PageBuilderController::make_component($r);
							}
							else 
							{
								if($items[0]!="list")
								{
									if($form_data!=NULL)
									{
										$field_options = $form_data[$item]["field_options"];
										$css_class_name = $form_data[$item]["css_class_name"];
											
									}
								}
								else
								{
									$field_options = NULL;
									$css_class_name = NULL;
								}
								PageBuilderController::make_component($r,$field_options,$css_class_name);
							}
					?>
<!-- 					{{$r}} -->
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
							<?php 
							$items = explode("#",$m) ;
							$item = $items[0];
							$num = $items[1];
							if($num==0)
							{
							$forms = PageBuilderController::make_component($m);
							}
							else 
							{
								if($items[0]!="list")
								{
									if($form_data!=NULL)
									{
										$field_options = $form_data[$item]["field_options"];
										$css_class_name = $form_data[$item]["css_class_name"];
											
									}
								}
								else
								{
									$field_options = NULL;
									$css_class_name = NULL;
								}
								PageBuilderController::make_component($m,$field_options,$css_class_name);
							}
					?>
<!-- 					{{$m}} -->
					@endforeach
				@endif
			</div>
			<div class="col-md-3 box">
				@if($right!=NULL)
					@foreach($right as $r)
							<?php 
							$items = explode("#",$r) ;
							$item = $items[0];
							$num = $items[1];
							if($num==0)
							{
							$forms = PageBuilderController::make_component($r);
							}
							else 
							{
								if($items[0]!="list")
								{
									if($form_data!=NULL)
									{
										$field_options = $form_data[$item]["field_options"];
										$css_class_name = $form_data[$item]["css_class_name"];
											
									}
								}
								else
								{
									$field_options = NULL;
									$css_class_name = NULL;
								}
								PageBuilderController::make_component($r,$field_options,$css_class_name);
							}
					?>
<!-- 					{{$r}} -->
					@endforeach
				@endif
			</div>
		</div>
	@endif	
	<div class="row">
		<div class="col-md-12 box" id="footer">
			@if($footer!=NULL)
				@foreach($footer as $f)
						<?php 
							$items = explode("#",$f) ;
							$item = $items[0];
							$num = $items[1];
							if($num==0)
							{
							$forms = PageBuilderController::make_component($f);
							}
							else 
							{
								if($items[0]!="list")
								{
									if($form_data!=NULL)
									{
										$field_options = $form_data[$item]["field_options"];
										$css_class_name = $form_data[$item]["css_class_name"];
											
									}
								}
								else
								{
									$field_options = NULL;
									$css_class_name = NULL;
								}
								PageBuilderController::make_component($f,$field_options,$css_class_name);
							}
					?>
<!-- 					{{$f}} -->
				@endforeach
			@endif
		</div>
	</div>
</div>

@stop