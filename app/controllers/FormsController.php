<?php 

/*
Forms controller: Controller to act as backend for form builder
*/
class FormsController extends BaseController
{
	

	/*
		This function gives control to user,, as to select a particular form from already created ones
		after selecting form, control goes to render form
	*/
	public fucntion select_form()
	{
		$forms = Form_config::all();
		return View::make('select_form',compact($forms));
	}
	



	/*
		Function for rendering form builder. This functions view is showing form builder	
	
	*/
	
	
	public function render_form_creator()
	{
		
	
	}
	/*
		Function for rendering created form
		This function can make use of model form_config and reproduce expected
		Route is already defined in order to recieve parameters for particular form from database
	*/
	public function render_form(Form_config $form)
	{
		$json_to_view = array('form_name' => $form->form_name,
					'form_desc' => $form->form_desc,
					'form_url'  => $form->form_url,
					'field_num' => $form->field_num,
					'desc_order'=>json_decode($form->desc_order,true));
		// returning details of form into view as json
		return Response::json($json_to_view);
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
						"css class name" : (class name),
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
	public function save_form()
	{
	
		
		$type_array = array(1=>'SLT',2=>'NUM',3=>'PARAGH',4=>'CHECK',5=>'MCHOICE',6=>'DROPDN');
		//  input is send as json, in above format
		$input = json_decode(file_get_contents("php://input"),true);
		
		
		$rules_config = array(
					'form_name'=>'required|alpha_num|size:2',
					'form_desc'=>'alpha_num|size:2',
					'form_url'=>'required',
					'desc_order'=>'required'
					'field_num'=>'required'
				 );
		$validator = Validation::make($input,$rules_config); // Validation for necessary fields
		if($validator->passes()) // If validation is passed then form should be saved

		{
			$form_config = new Form_config();  // model for saving form configuration
			$form_config->form_name = $input['form_name'];
			
			if(isset($input['form_desc'])
			{
				$form_config->form_desc = $input['form_desc'];
			}
			
			$form_config->form_url = $input['form_url'];
			$form_config->field_num = $input['field_num']; 
			// descriptional order is converted back to json in order to store it in db 

			$desc_order = json_encode($input['desc-order']);
			
			$form_config->desc_order = $desc_order;
			$form_config->save();
		}
	}
	/*
		function: save_form_data()
			This function saves data from form to database
			Form is reproduced in the order it was created
			
	*/
	public function save_form_data()
	{
		$form_data = new Form_data();
		
		$field_num = 1; 
		$type_array = array(1=>'SLT',2=>'NUM',3=>'PARAGH',4=>'CHECK',5=>'MCHOICE',6=>'DROPDN');
		
		// Loop to insert standard field names and its values
		// Taking each type of field  and check whether they are present in the form or not
		
		
		
		foreach($type_array as $key=>$type)
		{
			$i = 1;
			//checking whether $type_$i exist in input or not
			// for eg: SLT_1, NUM_4 etc
			
			while(Input::has($type.'_'.$i))
			{
				if(Form_data::col_exists('field_'.$field_num.'_name') == false) // check field_(number)_name exist or not. If not create a new one
				{
					Form_data::create_col($field_num,$key);
				}      // field_num is giving idea about which field is created
				$field = $type.'_'.$i;
				$col = 'field_'.$field_num.'_name';
				$col_value = 'field_'.$field_num.'_value';
				$form_data->$col = $field;
					
				$form_data->$col_value = $input[$field];
				$field_num++;
				$i++;
					
			}
		}
		$form_data->save();
		
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
	public function save_form_data_v2()
	{
		$form_data = new Form_data();
		
		$field_num = 1;
		$type_array = array(1=>'SLT',2=>'NUM',3=>'PARAGH',4=>'CHECK',5=>'MCHOICE',6=>'DROPDN');
	
		$input = json_decode(file_get_contents("php://input"),true);	

		$fdata = $input['form_data'];
// 		$counter = 0;
// 		// loop to check whether any fields violates 'require' rule
// 		foreach ($form_data as $field)
// 		{
// 			$value = $field["value"];
// 			foreach ($field as $att=>$att_value)
// 			{
// 				if($att=="required" && $att_value==1)
// 				{
// 					if($value==NULL)
// 					{
// 						$counter++;
// 						// counter increments when a "required" field contains nothing
// 						// error !!!
// 					}
// 					
// 				}
// 			}
// 		}
// 			
// 		if($counter!=0)
// 		{
// 			
// 		}

		// Loop to insert standard field names and its values
		// Taking each type of field  and check whether they are present in the form or not
		
		
		
		foreach($type_array as $key=>$type)
		{
			$i = 1;
			//checking whether $type_$i exist in input or not
			// for eg: SLT_1, NUM_4 etc
			
			while(array_key_exists($type.'_'.$i,$fdata)
			{
				if(Form_data::col_exists('field_'.$field_num.'_name') == false) // check field_(number)_name exist or not. If not create a new one
				{
					Form_data::create_col($field_num,$key);
				}      // field_num is giving idea about which field is created
				$field = $type.'_'.$i;
				$col = 'field_'.$field_num.'_name';
				$col_value = 'field_'.$field_num.'_value';
				$form_data->$col = $field;
					
				$form_data->$col_value = $fdata[$field]['value'];
				$field_num++;
				$i++;
					
			}
		}
		$form_data->save();
		
	}
}
?>