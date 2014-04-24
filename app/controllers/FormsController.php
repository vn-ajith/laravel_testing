<?php 

/*
Forms controller: Controller to act as backend for form builder
*/
class FormsController extends BaseController
{
	

	


	public function index()
	{
		return View::make('Forms.index');
	}	
	
	/*
		This function gives control to user,, as to select a particular form from already created ones
		after selecting form, control goes to render form
	*/
	
	public function select_form()
	{
		$forms = Form_config::all();
		return View::make('Forms.select_form',compact('forms'));
	}
	/*
		Function page_builder is used to set properties for page builder
		In this function user can select options for layout of page, forms that to be displayed in page and its position
	*/
	public function page_builder()
	{
		$forms = Form_config::all();
		$form_data = Form_data::all();
		$page_id = DB::table('page_builds')->max('id');
		$page_id++;
		return View::make('Forms.page_builder',array('forms'=>$forms,'form_data'=>$form_data,'page_id'=>$page_id))	;
	}
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
		return $str;
	}
	public function arrange_page_elements(Page_build $page)
	{
		$main_content = array();
		$left_side_bar = array();
		$right_side_bar = array();
		$p = json_decode($page->page_settings,true);
		$form = $p["form"];
		$form_data = $p["form_data"];
		$i = 1;
		foreach($form as $f)
		{
			if($f["position"]=="main_content")		
			{
				$main_content["item_".$i]["form_id"] = $f["form_id"];
				$main_content["item_".$i]["form_name"] = $f["form_name"];

			}
			else if($f["position"]=="left_side_bar")
			{
				$left_side_bar["item_".$i]["form_id"] = $f["form_id"];
				$left_side_bar["item_".$i]["form_name"] = $f["form_name"];
			}
			else if($f["position"]=="right_side_bar")
			{
				$right_side_bar["item_".$i]["form_id"] = $f["form_id"];
				$right_side_bar["item_".$i]["form_name"] = $f["form_name"];
			}
			$i++;
		}
		foreach($form_data as $fd)
		{
			$form_id = $fd["form_id"];
			$form_name = $fd["form_name"];
			$elements  = $fd["elements"];

			foreach($elements as $e)
			{
				
				if($e["position"]=="main_content")		
				{
					$main_content["item_".$i]["form_id"] = $form_id;
					$main_content["item_".$i]["form_name"] = $form_name;
					$main_content["item_".$i]["e_id"] = $e["id"];

				}
				else if($e["position"]=="left_side_bar")		
				{
					$left_side_bar["item_".$i]["form_id"] = $form_id;
					$left_side_bar["item_".$i]["form_name"] = $form_name;
					$left_side_bar["item_".$i]["e_id"] = $e["id"];

				}
				else if($e["position"]=="right_side_bar")		
				{
					$right_side_bar["item_".$i]["form_id"] = $form_id;
					$right_side_bar["item_".$i]["form_name"] = $form_name;
					$right_side_bar["item_".$i]["e_id"] = $e["id"];

				}

				$i++;
			}
		
		}
		return View::make("Forms.arrange_page_elements",array('page'=>$page,'main_content'=>$main_content,'left_side_bar'=>$left_side_bar,'right_side_bar'=>$right_side_bar));
		//$page_builds = Page_build::findOrFail();
		
	}
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
 				for($i=1;$i<=$field_num;$i++)
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
	public function save_page_build()
	{	
		$page_builds = new Page_build();
		$input = Input::all();
		
		
		$rules = array('view_type'=>'required',
				'settings'=>'required',
				);
		$validator = Validator::make($input,$rules);
		if($validator->passes())
		{
			$page_builds['view_type'] = $input['view_type'];
			$page_builds['page_settings'] = json_encode($input["settings"]);
			$page_builds->save();
			echo 'page settings saved';

		}
		else
		{
			echo 'Errors................>>>!@';
		}
		
		
	}

	/*
		Function for rendering form builder. This functions view is showing form builder	
	
	*/
	
	
	public function render_form_creator()
	{
		return View::make('Forms.render_form_creator');
	
	}
	/*
		Function for rendering created form
		This function can make use of model form_config and reproduce expected
		Route is already defined in order to recieve parameters for particular form from database
	*/
	public function render_form(Form_config $form)
	{
		$forms = array('form_name' => $form->form_name,
					'form_desc' => $form->form_desc,
					'form_url'  => $form->form_url,
					'form_id'   => $form->form_id,
					'desc_order'=>json_decode($form->desc_order),true);
		return View::make('Forms.render_form',array('form'=>$forms));
	}
	
	/*      Function: save_form()
		Function for saving form parameter to databse
		This function can handle multiple types of forms
		
		Naming that should be followed for form fields: 
			single line text : SLT_(number) eg: SLT_1, SLT_20
			Number : NUM_(number) eg: NUM_23
			Paragraph text: PARAGH_(number)  eg: PARAGH_25
			Checkbox: CHECK_(number) eg: CHECK_56
			Multiple choice: MCHOICE_(number) eg: MCHOICE_3
			Dropdown : DROPDN_(number) eg: DROPDN_2
		
		Numbers should be conitnuous
		eg:  if 3 single line fields, then names of fields should be SLT_1, SLT_2, SLT_3 
		
		
		Inputs to the form creation can be in json format
		format that should be followed: 
		
		{	"form_name":(name),
			"form_desc": (description) ,
			"form_url" : (url),
			"field_num" :(number of fields),
			"desc_order":{
					"(field name 1)": {
						"label" : (label),
						"default" : (default value),
						"values": 
						"css_class_name" : (class name),
						"field_size": (small/medium/large),
						"required": (0 for no, 1 for yes)

					},
					"(field name 2)":{
						"label" : (label),
						"default" : (default value),
						"css class name" : (class name),
						"field_size": (small/medium/large),
						"required": (0 for no, 1 for yes)

					}
				}
		}


			
	*/
	public function saveForm()
	{
	
		//return View::make('Forms.saveForm');

	
		$type_array = array(1=>'SLT',2=>'NUM',3=>'PARAGH',4=>'CHECK',5=>'MCHOICE',6=>'DROPDN');
		//  input is send as json, in above format
		//$input = json_decode(file_get_contents("php://input"),true);
		$input = Input::all();
		
		//$input['form_desc']);
 		$rules_config = array(
					'form_name'=>'required',
					'form_url'=>'required',
					'desc_order'=>'required',
					
				 );
		
		$validator = Validator::make($input,$rules_config); // Validation for necessary fields
		if($validator->passes()) // If validation is passed then form should be saved

		{
			$form_config = new Form_config();  // model for saving form configuration
			$form_config->form_name = $input['form_name'];
			
			if(isset($input['form_desc']))
			{
				$form_config->form_desc = $input['form_desc'];
			}
			
			$form_config->form_url = $input['form_url'];
			
			// descriptional order is converted back to json in order to store it in db 

			$desc_order = json_encode($input['desc_order']);
			
			$form_config->desc_order = $desc_order;
			$form_config->save();
		}
		else
		{
			echo 'error!!';
		}
		
		
	}



	//backup test function: This function works as if it gets parametrs as json when form is submitted
	
	/*
		Format json to used when form is submitted
		format that should be followed: 
		
		{	"form_id": (id of form)
			"form_name":(name),
			"form_desc": (description) ,
			"form_url" : (url),
			"field_num" :(number of fields),
			"form_data":{
					"(field name 1)": {
						"label" : (label),
						"css class name" : (class name),
						"required": (0 for no, 1 for yes),
						"value":(value)

					},
					"(field name 2)":{
						
						"label" : (label),
						"css class name" : (class name),
						"required": (0 for no, 1 for yes),
						"value":(value)
					}
				}
		}
	*/
		// field verification can be easily done at view
	public function save_form_data()
	{
		$form_data = new Form_data();
		
		$field_num = 1;
		$type_array = array(1=>'SLT',2=>'NUM',3=>'PARAGH',4=>'CHECK',5=>'MCHOICE',6=>'DROPDN');
	
		
		$input = Input::all();
		var_dump($input);
		$fdata = $input['form_data'];
 		$form_data->form_id = $input['form_id'];
 		$form_data->form_name = $input['form_name'];

 		
		foreach($type_array as $key=>$type)
		{
			$i = 1;
			//checking whether $type_$i exist in input or not
			// for eg: SLT_1, NUM_4 etc
			
			while(array_key_exists($type.'_'.$i,$fdata))
			{
				if(Form_data::col_exists('field_'.$field_num.'_name') == false) // check field_(number)_name exist or not. If not create a new one
				{
					Form_data::create_col($field_num,$key);
				}      // field_num is giving idea about which field is created
				$field = $type.'_'.$i;
				$col = 'field_'.$field_num.'_name';
				$col_value = 'field_'.$field_num.'_value';
				$form_data->$col = $field."#".$fdata[$field]['label'];
				$value = $fdata[$field]["value"];
				if(is_numeric($fdata[$field]))		
				{
					$form_data->$col_value = floatval($value);
					
				}
				else
				{
				$form_data->$col_value = $value;
				}
				$field_num++;
				$i++;
					
			}
		}
		$field_num--;
		$form_data->field_num = $field_num;
		$form_data->save();
		
	}
	

}
?>