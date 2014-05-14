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
		$level = 0;
		$nav_array = array();
		$list_details = json_decode($list->list_details,true);
		$nav_details = $list_details["nav_details"];
		foreach($nav_details as $nav)
		{
			if($nav["parent"]==NULL)
			{
				$nav_array[$nav["url"]] = array();
			}
		}
		foreach($nav_details as $nav)
		{
			if($nav["parent"]!=NULL)
			{
// 				if()
// 				{
// 					echo 's='.$nav["parent"];
// 					echo 'second level';
// 				}
// 				else
// 				{
// 					echo "f= ".$nav["parent"];
// 					echo 'first level';
// 				}
				$index = explode("_",$nav["parent"]);
				
				
				if(stristr($nav["parent"],"_"))
				{
					$nav_array[$nav["parent"]] = $nav["url"];
				}
				else
				{
					$nav_array[$nav["parent"]] = array();
// 					$temp = &$nav_array[$index[0]];
// 					
// 					for($i = 1;$i<count($index);$i++)
// 					{
// 						if(isset($temp[$index[$i]]))
// 						{
// 						$temp = $temp[$index[$i]];
// 						
// 						}
// 						else
// 						{
// 							$temp[$index[$i]] = array();
// 						}
// 					}
// 					$temp = $nav["url"];
				}
			}
		}
		
		print_r($nav_array);
		
	}
	public function do_something()
	{
		
	}
}
?>