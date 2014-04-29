<?php
class NavigationsController extends BaseController
{

	public function navigation_builder()
	{
		return View::make('Navigations.navigation_builder');
	}
	public function save_navigation()
	{
		$input = Input::all();
		$nav = new Navigation();
		
		$rules = array("nav_details"=>"required");
		$validator = Validator::make($input,$rules);
		if($validator->passes())
		{
			$nav->nav_details = json_encode($input["nav_details"]);
			$nav->save();
		}
		else
		{	
			echo 'Error!!';
		}
		
	}
}
?>