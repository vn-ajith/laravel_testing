<?php

class PageBuilderController extends BaseController
{

	/*
		Function page_builder is used to set properties for page builder
		In this function user can select options for layout of page, forms that to be displayed in page and its position
	*/
	public function page_build()
	{
		if(Session::get("account_id")!=NULL)
		{
			$forms = Form_config::all();
			$form_data = Form_data::all();
			
			$lists = ListBuild::all();
			return View::make('PageBuilder.page_builder',array('forms'=>$forms,'form_data'=>$form_data,'lists'=>$lists));
		}
		else
		{
			return Redirect::action("UsersController@login");
		}
	}
	public function page_render(Page_builds $page)
	{
		if(Session::get("account_id")!=NULL)
		{
			$box_order = json_decode($page->box_order,true);
			$page_settings = json_decode($page->page_settings,true);
			
			if(isset($box_order["header"]))
			{
				$header = $box_order["header"];
			}
			else
			{
				$header = NULL;	
			}
			if(isset($box_order["footer"]))
			{
				$footer = $box_order["footer"];
			}
			else
			{
				$footer = NULL;
			}
			if(isset($box_order["left"]))
			{
				$left = $box_order["left"];
			}
			else 
			{
				$left = NULL;
			}
			if(isset($box_order["main"]))
			{
				$main = $box_order["main"];
			}
			else
			{
				$main = NULL;
			}
			if(isset($box_order["right"]))
			{
				$right = $box_order["right"];
			}
			else
			{
				$right = NULL;
			}
			if(isset($page_settings["form"]))
			{
				$form = $page_settings["form"];
			}
			else 
			{
				$form = NULL;
			}
			if(isset($page_settings["form_data"]))
			{
				$form_data = $page_settings["form_data"];
			}
			else
			{
				$form_data = NULL;
			}
			if(isset($page_settings["lists"]))
			{
				$lists = $page_settings["lists"];
			}
			else
			{
				$lists = NULL;
			}
			return View::make("PageBuilder.page_render",array("page"=>$page,"header"=>$header,"footer"=>$footer,"left"=>$left,"main"=>$main,"right"=>$right,"lists"=>$lists,"form_data"=>$form_data));
		}
		else
		{
			return Redirect::action("UsersController@login");
		}
	}
	
	/*
		function: generate_select_box
			this function generates options for position in both form and form data selection 
			
	*/
	public function generate_select_box($val)
	{
		
		$str="";
		
		$str = $str."<option value='main_content'>Main content</option>";
		if($val=="3_col_view"){
		
			$str = $str."<option value='left_side_bar'>Left side bar</option>";
			$str = $str."<option value='right_side_bar'>Right side bar</option>";
			
		}
		else if($val=="2_col_left_view"){
		
			$str = $str."<option value='left_side_bar'>Left side bar</option>";
		
		}
		else{
		
			$str = $str."<option value='right_side_bar'>Right side bar</option>";
		}
		$str = $str."<option value='header'>Header</option>";
		$str = $str."<option value='footer'>Footer</option>";
		
		return $str;
	}
	
	/*
		Function : generate_form_data_table()
			This function generates table of data which is already entered using a particular form
			It is generated when a form is selected
	*/
	public function generate_form_data_table()
	{
		$input = Input::all();
 		$id = $input['id'] ;
		$radio = $input['radio'];
		$form_data = Form_data::where('form_id', '=', $id)->get();
		
		$t_head = array();
		if ($form_data->isEmpty())
		{
			echo '<p> Currently, there is no form data available !</p>';
		}
		else
		{
			echo '<div class="table-responsive">';
			echo '<table class="table">';
			echo '<thead>';
			echo '<tr>';
			foreach($form_data as $f)
			{
				$i = 1;
				
				$name = 'field_'.$i.'_name';
									
 				$field_num = intval($f['field_num']);
				echo '<th></th>';
 				for($i=1;$i<=$field_num;$i++) //  loop for getting label names of selected table
				{
					
 					$field = $f['field_'.$i.'_name'];
 					
						if(!($field==NULL))
						{
							
							$pos = strpos($field,"#");
							
							$c = strlen($field)-$pos-1;
							$sub = substr($field,$pos+1,$c);
							$t_head[] = $sub; 			
							
							
						}
					
 				}
				break;
			}
				for($k=0;$k<count($t_head);$k++)
				{
					echo '<th>'.$t_head[$k].'</th>';
				}
				echo '<th>Position</th>';
				echo '</tr>';
				echo '</thead>';
			
				echo '<tbody>';
			foreach($form_data as $f)
			{	
				echo '<tr>';
				echo '<td><input type="checkbox" id="'.$f['id'].'" name="element"></td>';
				for($i=1;$i<=$field_num;$i++)
				{
					echo '<td>'.$f['field_'.$i.'_value'].'</td>';
					
				}
				echo '<td><select id="pos_data_'.$id.'_'.$f['id'].'">'.$this->generate_select_box($radio).'</select></td>';
				echo '</tr>';
				

			}
			echo '</tbody>';
 			echo '</table>';
			echo '</div>';
			echo '<p><label>Select fields to display</label></p>';
			echo '<div class="checkbox">  <label> <input type="checkbox" name="field_options" value="all">All  </label></div>';
			foreach($t_head as $op)
			{
				echo '<div class="checkbox">  <label> <input type="checkbox" name="field_options" value="'.$op.'">'.$op.'</label></div>';
			}
			echo '<p><label>Css class </label></p>';
			echo "<input type='text' id='form_data_css_class' class='form-control' style='width:50%;'>";
			
			
			
		}					

	}
	public function deletePage(Page_builds $page)
	{
		$page->delete();
		return Redirect::action("UsersController@dashboard");
	}
	public static function make_component($tag,$field_options=NULL,$css_class_name=NULL)
	{
		if(strpos($tag,"list")===false)	
		{
			
			$forms = explode("#",$tag) ;
			$form_id = $forms[0];
			$item_id = $forms[1];
			if($item_id>=1)
			{
				
				$str = FormsController::make_form_data($item_id,$field_options,$css_class_name);
				
				echo $str;
				
				
			}
			else
			{
			$form = Form_config::findOrFail($form_id);
			
			$f = array('form_name' => $form->form_name,
					'form_desc' => $form->form_desc,
					'form_url'  => $form->form_url,
					'form_id'   => $form->form_id,
					'desc_order'=>json_decode($form->desc_order,true));
		
 			return $f;
			}	
		
		}
		else
		{	
			$lists = explode("#",$tag);
			$list_id = $lists[1];
			ListBuilderController::list_maker($list_id);
		}
	}

	

	/*
		Function save_page()
			This function saves properties of page ie., selected layout, forms, form data, their order of display etc. to database
			box_order as well as settings are passed as json from view

			box order is order of elements in a page
				format: item#number : (form_id)#(form_data_id)
			settings saves overall elements in page
				format: every element is saved with form id, form name if form data id if exists
	*/
	public function save_page()
	{	
		if(Session::get("account_id")!=NULL)
		{
			
			$page_builds = new Page_builds();
			$input = Input::all();
			
			
			$rules = array('view_type'=>'required',
					'box_order' =>'required'
					);
			$validator = Validator::make($input,$rules);
			if($validator->passes())
			{
				$page_builds->page_name = $input['page_name'];
				$page_builds->view_type = $input['view_type'];
				if(isset($input["settings"]))
				{
					$page_builds->page_settings = json_encode($input["settings"]);
				}
				else
				{
					$page_builds->page_settings = " ";
				}
				$page_builds->box_order = json_encode($input["box_order"]);
				$page_builds->account_id = Session::get("account_id");
				$page_builds->save();
				echo 'page settings saved';
	
			}
			else
			{
				echo 'Errors...!';
			}
		}
		else
		{
			echo 'Login first!!';
		}
		
	}	
}
?>