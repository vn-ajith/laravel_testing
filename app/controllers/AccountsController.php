<?php
class AccountsController extends BaseController 
{
	public function __construct() 
	{
 		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->beforeFilter('auth', array('only'=>array('dashboard')));
	}
	
}
?>