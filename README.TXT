
function: save_form_data_v2() 
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


Function: save_form()
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




function : render_form_creator()
		This function renders form creation page It renders a view that gives control to user who can make a form with different controls


function :  render_form(Form_config $form)

		Function for rendering created form
		This function can make use of model form_config and reproduce expected
		Route is already defined in order to recieve parameters for particular form from database
		an argument is passed in url. since we are going rendering a form that is already created
		Details of selected form is retrieved by model form_configs


function : select_form()

		This function gives control to user,, as to select a particular form from already created ones
		after selecting form, control goes to render form