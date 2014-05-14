<?php
class ListBuilderController extends BaseController
{

	public function list_builder()
	{
		return View::make('ListBuilder.navigation_builder');
	}
	public function save_list()
	{
		$input = Input::all();
		
		$list = new ListBuild();
		
		$rules = array("list_name"=>"required","list_details"=>"required");
		$validator = Validator::make($input,$rules);
		if($validator->passes())
		{
			$list->list_name = $input["list_name"];
			$list->list_details = json_encode($input["list_details"]);
			$list->save();
			echo 'List saved successfully !';
		}
		else
		{	
			echo 'Error!!';
		}
		
	}
	public static function list_maker($list_id)
	{
		$list = ListBuild::findOrFail($list_id);
		$str = "";
		$list_details = json_decode($list->list_details,true);
		$nav_details = $list_details["nav_details"];
		
	}
}
?>