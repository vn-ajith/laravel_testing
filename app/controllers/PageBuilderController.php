<?php

class PageBuilderController extends BaseController
{

	/*
		Function page_builder is used to set properties for page builder
		In this function user can select options for layout of page, forms that to be displayed in page and its position
	*/
	public function page_build()
	{
		$forms = Form_config::all();
		$form_data = Form_data::all();
		$page_id = DB::table('page_builds')->max('id');
		
		$page_id++;

		return View::make('PageBuilder.page_builder',array('forms'=>$forms,'form_data'=>$form_data,'page_id'=>$page_id))	;
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
		$page_builds = new Page_build();
		$input = Input::all();
		
		
		$rules = array('view_type'=>'required',
				'settings'=>'required',
				'box_order' =>'required'
				);
		$validator = Validator::make($input,$rules);
		if($validator->passes())
		{
			$page_builds->view_type = $input['view_type'];
			$page_builds->page_settings = json_encode($input["settings"]);
			$page_builds->box_order = json_encode($input["box_order"]);
			$page_builds->save();
			echo 'page settings saved';

		}
		else
		{
			echo 'Errors................>>>!@';
		}
		
		
	}	
}
?>