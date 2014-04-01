<?php 
/*
Model for handling data fields associated  with each form id.
different fields and its values saved using this model
*/
class Form_data extends Eloquent
{
	protected $table = 'form_datas';
	public static $key = 'form_id';
}
?>