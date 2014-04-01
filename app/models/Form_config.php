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
}
?>