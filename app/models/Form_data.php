<?php 
/*
Model for handling data fields associated  with each form id.
different fields and its values saved using this model
*/
class Form_data extends Eloquent
{
	protected $table = 'form_datas';
	public static $key = 'form_id';
	
	
	public function __construct()
	{	
		if(!Schema::hasTable(form_datas))
		{
			Schema::create('form_datas',function($table)
			{
				$table->increments('form_id');
				$table->foreign('form_id')->references('form_id')->on('form_configs');
			});
		}
	}



	/*
		Function to check whether a particular column exist in table or not 
	*/
	
	public static function col_exists($col_name)
	{
		if(Schema::hasColumn('form_datas',$col_name))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	/*
		Function to create a column in tabele dynamically
		num identifies number attached to the new column name
		type identifies field type to be created
		
		one field in form corresponds to following fields=> fields name and field value
		type :
							  DATABASE TYPE
			1: Single line field   ---------> string
			2: Number              ---------> integer
			3: Paragraph text      ---------> text
			4: Checkbox            ---------> text
			5: Multiple choice     ---------> text
			6.: Dropdown           ---------> text
		

		single line text : SLT_(number) eg: SLT_1, SLT_20
			Number : NUM_(number) eg: NUM_23
			Paragraph text: PARAGH_(number)  eg: PARAGH_25
			Checkbox: CHECK_(number) eg: CHECK_56
			Multiple choice: MCHOICE_(number) eg: MCHOICE_3
			Dropdown : DROPDN_(number) eg: DROPDN_2
	*/
	
	public static function create_col($num = 0,$type)
	{
			//$type_array = array(1=>'SLT',2=>'NUM',3=>'PARAGH',4=>'CHECK',5=>'MCHOICE',6=>'DROPDN');
						
			$col_name_db = 'field_'.$num.'_name';		// new column to be generated
			$value_name_db = 'field_'.$num.'_value';  // value field of new column 
			
			Schema::table('form_datas', function($table)
			{
				
				$table->string($col_name_db,'100')
				if($type == 1)
				{
					$table->string($value_name_db,'100')->after($col_name_db);
				}
				else if($type == 2)
				{
					$table->integer($value_name_db,'100')->after($col_name_db);
				}
				else
				{
					$table->text($value_name_db,'100')->after($col_name_db);
				}
				
				/*
					column is created in such way that same type fields are adjacent
				*/

				
			});
		
		
	}

}
/*
eg: 
Table : form_datas
--------------------------------------------------------------------
form_id | field_1_name | field_1_value | ...........................
--------------------------------------------------------------------
   1 :  | SLT_1        | this is test  | ............................
---------------------------------------------------------------------
   2 :  | NUM_1        | 563           | ............................
---------------------------------------------------------------------

*/
?>
