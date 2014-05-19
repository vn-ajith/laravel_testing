<?php
class ListBuilderController extends BaseController
{

	public $menuItems;
        public $parentMenuIds;
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
		$lists = $list_details["nav_details"];
		$level = 0;

		foreach($lists as $l)
		{
			$temp = (strlen($l["parent"])+1)/2;
			
			if($temp>=$level)
			{
				$level = $temp;
			}
		}
	

		$level_array = array();
		for($i=0;$i<=$level;$i++)
		{
			$level_array[$i]= array();
		}
		foreach($lists as $l)
	
		{
			$temp = (strlen($l["parent"])+1)/2;
			$index = explode("_",$l["parent"]);
			
	
			if(count($index)>=1)
			{
				$level_array[$temp][$l["url"]] = array("url"=>$l["url"],"parent"=>$index[count($index)-1]);
			}	
			else
			{
				$level_array[$temp][$l["url"]] = array("url"=>$l["url"]);
			}
		}

		for($i=$level;$i>=1;$i--)
		{
			foreach($level_array[$i] as $url)
			{
				foreach($level_array[$i-1] as &$parent)
				{
					if($url["parent"]==$parent["url"])
					{
						$parent["child"][] =$url; 
					}
				}
			}
		}	
		$list_array = $level_array[0];
		$str = "<ul>";
		$s ="";
		foreach($list_array as $url)
		{
	
	
			if(isset($url["child"]))
			{	
				$children = $url["child"];	
				$str = $str ."<li>".$url["url"];
				
				foreach($children as $node)
				{
					$s = "";
					$str = $str.ListBuilderController::child($node);
				}
				$str = $str.'</li>';
			}
			else
			{
				$str = $str ."<li>".$url["url"].'</li>';
			}
	
		}
		$str = $str."</ul>";
		echo $str;
		
	}
	public static function child($n)
	{
		$s="";
		if(!isset($n["child"]))
		{
			$sa= "<ul><li>".$n["url"]."</li></ul>";
			return $sa;
		}
		else
		{
			$node_child = $n["child"];
			$s = $s.'<ul><li>'.$n["url"];
			
			
			foreach($node_child as $node )
			{
			
			$s = $s. ListBuilderController::child($node);
			}
			$s = $s.'</li></ul>';
			
		}
		return $s;
	}

	public static function do_something($list_id)
	{
		global $menuItems;
                global $parentMenuIds;
		$list = ListBuild::findOrFail($list_id);
		$list_details = json_decode($list->list_details,true);
		$menuItems = $list_details["nav_details"];
		
		echo $str= "  <div class='navbar navbar-inverse'>
      <div class='navbar-inner navbar-inverse'>
        <div class='container'>
           <a class='btn btn-navbar' data-toggle='collapse' data-target='.navbar-responsive-collapse'>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
          </a>
          <a class='brand' href='#'>Title</a>
          <div class='nav-collapse collapse navbar-responsive-collapse'>
            <ul class='nav'>";
		
		foreach($menuItems as $parentId)
                {
                  $parentMenuIds[] = $parentId["parent"];
                }
		
		ListBuilderController::generate_menu(0);
		echo "  </li>
            		</ul>
          		</div><!-- /.nav-collapse -->
        		</div>
      			</div><!-- /navbar-inner -->
    			</div>  ";
	
	}
	public static function generate_menu($parent)
        {
		$has_childs = false;
                
                        //this prevents printing 'ul' if we don't have subcategories for this category
		global $menuItems;
                global $parentMenuIds;
				
                        //use global array variable instead of a local variable to lower stack memory requierment
                foreach($menuItems as $key => $value)
                {
                 	if ($value["parent"] == $parent) 
                        {    
                        	        //if this is the first child print '<ul>'
                                if ($has_childs === false)
                                {
                                  	//don't print '<ul>' multiple times  
                                  	$has_childs = true;
                                  	if($parent != 0)
                                  	{
                                    		echo '<ul class="dropdown-menu">';
                                  	}
                                }
                                
                                if($value["parent"] == 0 && in_array($value["id"], $parentMenuIds))
                                {
                                 	 echo '<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">' . $value["title"] . '<b class="caret"></b></a>';
                                }
                                else if($value["parent"] != 0 && in_array($value["id"], $parentMenuIds))
                                {
                                	  echo '<li class="dropdown-submenu"><a href="#">' . $value["title"] . '</a>';
                                }
                        	else
                        	{
                        		echo '<li><a href="#">' . $value["title"] . '</a>';
                        	}
                        	ListBuilderController::generate_menu($value["id"]);
                                
                                //call function again to generate nested list for subcategories belonging to this category
                        	echo '</li>';
                	}
		}
                if ($has_childs === true) echo '</ul>';
	}
}

?>