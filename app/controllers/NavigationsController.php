<?php
class NavigationsController extends BaseController
{

	public function navigation_builder()
	{
		return View::make('Navigations.navigation_builder');
	}
}
?>