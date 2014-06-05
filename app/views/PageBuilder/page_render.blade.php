@extends("layout_page_render")
@section("content")

<style>
div.list {
	list-style: none; 
}
.buttons { 
	margin-bottom: 20px; 
}

div.list div.li {
	width: 100%;
	border: 1px dotted #CCC;
	padding: 20px;
	padding-bottom: 10px; 
	margin:5px;	
}


div.grid div.li {
	float: left;
	width: 20%;
	border: 1px dotted #CCC;
	padding: 20px; 
	margin:5px;
}

</style>
<script type="text/javascript">
$(document).ready(function(){

$('button').on('click',function(e) {
    if ($(this).hasClass('grid')) {
        $('#container div#box').removeClass('list').addClass('grid');
    }
    else if($(this).hasClass('list')) {
        $('#container div#box').removeClass('grid').addClass('list');
    }
});
$('a').on('click',function(e) {
    if ($(this).hasClass('grid')) {
        $('div.box').removeClass('list').addClass('grid');
    }
    else if($(this).hasClass('list')) {
        $('div.box').removeClass('grid').addClass('list');
    }
});
});	
</script>	
<?php
	$view_type =  $page->view_type;
	$form = Form_config::findOrFail(4);
	$forms = array('form_name' => $form->form_name,
					'form_desc' => $form->form_desc,
					'form_url'  => $form->form_url,
					'form_id'   => $form->form_id,
					'desc_order'=>json_decode($form->desc_order,true));
		/*<!-- @include("Forms.render_form",array("form"=>$forms)) -->*/
		
?>
<!-- <link href="../assets/css/grid_list_style.css" rel="stylesheet">  -->
<!-- <script src="../assets/js/page_render.js" type="text/javascript"></script> -->
<script src="../assets/js/save_form_data.js" type="text/javascript"></script>
<div class="container">
	
	<div class="row">
		<div class="col-md-12 box" id="header">
			<div class="list box" >
			@if($header!=NULL)
				@foreach($header as $h)
						<?php 
							$items = explode("#",$h) ;
							$item = $items[0];
							$num = $items[1];
							if($num==0)
							{
							$f = PageBuilderController::make_component($h);
						?>
							<div style="clear:both"></div>
							@include("../form",array("form"=>$f))
						<?php
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
	</div>
	@if($grid_list_view==1)
		<div class="col-md-12">
			<div class="well well-sm">
				<strong>Category Title</strong>
				<div class="btn-group">
					<a href="#" id="list" class="btn btn-default btn-sm list"><span class="glyphicon glyphicon-th-list">
						</span>List</a> <a href="#" id="grid" class="btn btn-default btn-sm grid"><span
						class="glyphicon glyphicon-th"></span>Grid</a>
				</div>
			</div>
		</div>
	@endif
	@if($view_type =="2_col_left_view")
		<div class="row">
			<div class="col-md-3 box">
				<div class="list box" >
				@if($left!=NULL)
					
					@foreach($left as $l)
							<?php 
							$items = explode("#",$l) ;
							$item = $items[0];
							$num = $items[1];
							if($num==0)
							{
							$f = PageBuilderController::make_component($l);
							?>
							<div style="clear:both"></div>
							@include("../form",array("form"=>$f))
							<?php
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

					@endforeach
				@endif
				</div>
			</div>
			<div class="col-md-9 box">

				<div class="list box" >
				@if($main!=NULL)
					@foreach($main as $m)
							<?php 
							$items = explode("#",$m) ;
							$item = $items[0];
							$num = $items[1];
							if($num==0)
							{
							$f = PageBuilderController::make_component($m);
							?>
							<div style="clear:both"></div>
							@include("../form",array("form"=>$f))
							<?php
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

					@endforeach
				@endif
				</div>
			</div>
		</div>
	@endif	
	@if($view_type =="3_col_view")
		<div class="row">
			<div class="col-md-3 box">
				<div class="list box" >
				@if($left!=NULL)
					
					@foreach($left as $l)
							<?php 
							$items = explode("#",$l) ;
							$item = $items[0];
							$num = $items[1];
							if($num==0)
							{
							$f = PageBuilderController::make_component($l);
							?>
							<div style="clear:both"></div>
							@include("../form",array("form"=>$f))
							<?php
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

					@endforeach
				@endif
				</div>
			</div>
			<div class="col-md-6 box">
				<div class="list box" >
				@if($main!=NULL)
					@foreach($main as $m)
						<?php 
							$items = explode("#",$m) ;
							$item = $items[0];
							$num = $items[1];
							if($num==0)
							{
							$f = PageBuilderController::make_component($m);
						?>
							<div style="clear:both"></div>
							@include("../form",array("form"=>$f))
						<?php
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

					@endforeach
				@endif
				</div>
			</div>
			<div class="col-md-3 box">
				<div class="list box" >
				@if($right!=NULL)
					@foreach($right as $r)
							<?php 
							$items = explode("#",$r) ;
							$item = $items[0];
							$num = $items[1];
							if($num==0)
							{
							$f = PageBuilderController::make_component($r);
							?>
							<div style="clear:both"></div>
							@include("../form",array("form"=>$f))
							<?php
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
		</div>
	@endif	
	@if($view_type =="2_col_right_view")
		<div class="row">
			<div class="col-md-9 box">
				<div class="list box">
				@if($main!=NULL)
					@foreach($main as $m)
							<?php 
							$items = explode("#",$m) ;
							$item = $items[0];
							$num = $items[1];
							if($num==0)
							{
							$f = PageBuilderController::make_component($m);
							?>
							<div style="clear:both"></div>
							@include("../form",array("form"=>$f))
							<?php
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

					@endforeach
				@endif
				</div>
			</div>
			<div class="col-md-3 box">
				<div class="list box">
				@if($right!=NULL)
					@foreach($right as $r)
							<?php 
							$items = explode("#",$r) ;
							$item = $items[0];
							$num = $items[1];
							if($num==0)
							{
							$f = PageBuilderController::make_component($r);
							?>
							<div style="clear:both"></div>
							@include("../form",array("form"=>$f))
							<?php	
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
		</div>
	@endif	
	<div class="row">
		<div class="col-md-12 box" id="footer">
			<div class="list box">
			@if($footer!=NULL)
				@foreach($footer as $f)
						<?php 
							$items = explode("#",$f) ;
							$item = $items[0];
							$num = $items[1];
							if($num==0)
							{
							$f = PageBuilderController::make_component($f);
							?>
							<div style="clear:both"></div>
							@include("../form",array("form"=>$f))
							<?php
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
</div>

@stop