<?php

class Menu
{

	private $menu = array();

	public function __construct()
	{
		$fileData = file_get_contents(dirname(__FILE__)."/../../data/menu.dat");
		$this->menu = json_decode($fileData,true);
	}

	public function getMenu()
	{
		return $this->menu;
	}

}
