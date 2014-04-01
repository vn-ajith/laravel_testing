<?php 

/*
Forms controller: Controller to act as backend for form builder
*/
class FormsController extends BaseController
{
	/*
		Function for rendering form builder. This functions view is showing form builder	
	*/
	public function render_form()
	{
	
	}
	/*
		Function for saving form parameter and form data to databse
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
			
	*/
	public function save_form()
	{
	
		$input = Input::all();
		$type_array = array(1=>'SLT',2=>'NUM',3=>'PARAGH',4=>'CHECK',5=>'MCHOICE',6=>'DROPDN');
		
		
		$rules_config = array(
					'form_name'=>'required|alpha_num|size:2',
					'form_desc'=>'alpha_num|size:2',
					'form_url'=>'required',
					
				     );
		$validator = Validation::make($input,$rules_config);
		if($validator->passes())
		{
			$form_config = new form_configs();
			$form_config->form_name = $input['form_name'];
			if(Input::has('form_desc'))
			{
				$form_config->form_desc = $input['form_desc'];
			}
			$form_config->form_url = $input['form_url'];
			$form_config->num_fields = $num_fields; // to be determined
			$form_config->save();
		}
	}

}
?>