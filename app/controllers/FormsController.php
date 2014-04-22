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
		return View::make('Forms.page_builder',array('forms'=>$forms,'form_data'=>$form_data))	;
	}
	
	public function generate_form_data_table()
	{
		$input = Input::all();
 		$id = $input['id'] ;
		
		$form_data = Form_data::where('form_id', '=', $id)->get();;
		$t_head = array();
		if ($form_data->isEmpty())
		{
			echo '<p> Currently, there is no form data available !</p>';
		}
		else
		{
			foreach($form_data as $f)
			{
				$i = 1;
				while(array_key_exists('field_'.$i.'_name',$f))
				{
					$field = $f['field_'.$i.'_name'];
					var_dump($field);	
						if(!($field==NULL))
						{
							$field_name = $f->$field;	
							$pos = strpos($field_name,"#");
							$c = strlen($field_name)-$pos-1;
							$sub = substr($field_name,$pos+1,$c);
							var_dump($sub);
							$t_head =  $sub;
						}
					$i++;
				}
			}
		}					
// 			echo '	<div class="table-responsive">';
// 			echo '<table class="table">';
// 			echo '<thead>';
// 			echo '<tr>';
// 							
// 							<th>Form name</th>
// 							<th>Form description</th>
// 							
// 							</tr>
// 							</thead>
// 							<tbody>
// 							@foreach($forms as $form)
// 							<tr>
// 							<td><input type="checkbox" id="{{$form->form_id}}" name="check" value="{{$form->form_name }}"  ></td>
// 							<td>{{$form->form_name }}</td>
// 							<td>{{$form->form_desc}}</td>
// 							
// 							<td>	
// 								<select id="position_{{$form->form_id}}">
// 				
// 				
// 								</select>
// 							</td>			
// 							</tr>
// 							@endforeach
// 							</tbody>
// 						</table>
// 						@endif
// 					</div>
// 
// 		}















	}
	public function save_page_build()
	{	
		$page_builds = new Page_build();
		$input = Input::all();
		
		print_r($input);
// 		$rules = array('selected_form'=>'required',
// 				'view_type'=>'required',
// 				'position'=>'required',
// 				'form_id'=>'required');
// 		$validator = Validator::make($input,$rules);
// 		if($validator->passes())
// 		{
// 			page_settings
// 			$page_builds['form_id'] = $input['form_id'];
// 			$page_settings = array('position'=>$input['position'],
// 						'selected_form' =>$input['selected_form'],
// 						'view_type'=>$input['view_type']
// 						);
// 			
// 			$page_builds['page_settings'] = json_encode($page_settings);
// 			$page_builds->save();
// 			echo 'page settings saved';
// 
// 		}
// 		else
// 		{
// 			echo 'Errors................>>>!@';
// 		}
		
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
		$form_data->save();
		
	}
	

}
?>