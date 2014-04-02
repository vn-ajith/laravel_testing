<?php 

/*
Forms controller: Controller to act as backend for form builder
*/
class FormsController extends BaseController
{
	/*
		Function for rendering form builder. This functions view is showing form builder	
	
	*/
	
	
	public function render_form_creator()
	{
	
	}
	/*
		Function for rendering created form
		This function can make use of model form_config and reproduce expected
	*/
	public function render_form()
	{
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
		
		pass data as following: 
		
		"field_num" => number of fields in form
		'form_name'=>'Name of form
		'form_desc'=>'Description of form if any
		'form_url'=> It should be save_form_data() function 
		desc-order=> field gives information about order of form and names of fields
			this value should be output of form.serialize() method in jquery
		
			
	*/
	public function save_form()
	{
	
		$input = Input::all();
		$type_array = array(1=>'SLT',2=>'NUM',3=>'PARAGH',4=>'CHECK',5=>'MCHOICE',6=>'DROPDN');
		
		
		
		$field_num = $input['field_num'];
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
			
			if(Input::has('form_desc'))
			{
				$form_config->form_desc = $input['form_desc'];
			}
			
			$form_config->form_url = $input['form_url'];
			$form_config->field_num = $field_num; 
			$form_config->desc_order = $input['desc-order'];
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
		foreach($type_array as $key=>$type)
		{
			$i = 1;
			while(Input::has($type.'_'.$i))
			{
				if(Form_data::col_exists('field_'.$field_num.'_name') == false) // check field_(number)_name exist or not. If not create a new one
				{
					Form_data::create_col($field_num,$key);
				}
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

}
?>