<?php 
/*

Model for handling configurations of form
like form name, form id , URL to which form is posted, form description
redirection URL, number of fields associated
*/
class Form_config extends Eloquent
{
	protected $table = 'form_configs';
	public static $key = 'form_id';

	/*
		Table creation is done in constructor.
		Table is created if not exits
	*/	
	public function __construct()
	{
		if (!Schema::hasTable('form_configs'))
		{
    			Schema::create('form_configs',function($table){
				$table->increments('form_id'); // Form id
				$table->string('form_name','50'); // Form name
				$table->text('form_desc')->nullable();  // Description of form
									// Form description can be null
				$table->text('form_url');  // URL to which form is posted
				$table->integer('field_num');  // Number of fields in form
				$table->text('desc_order');  // This field gives idea about order of fields and its descriptions
				/*
					desc_order = > idea about order fields eg: 3 fields, first single line text, then number then paragraph. It also gives names of fields
				*/
			
			});			
		}
		
	}
	
}
?>