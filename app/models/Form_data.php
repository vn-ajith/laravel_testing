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
	
	public function col_exists($col_name)
	{
		if(Schema::hasColumn('form_datas'))
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
		col_name identifies new column to be created 
		type identifies field type to be created
		
		one field in form corresponds to following fields=> fields name and field value
	*/
	
	public function create_col($col_name,$type)
	{
		
		
	}
}
?>