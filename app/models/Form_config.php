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
				$table->integer('num_fields');  // Number of fields in form
			
			});			
		}
		
	}
	
	public function col_exists($col_name)
	{
		
		
	}
}
?>