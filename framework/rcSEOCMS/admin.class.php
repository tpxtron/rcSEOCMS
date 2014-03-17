<?php

class Admin
{

	private $config;
	private $action = "index";
	private $templateVars = array();

	public function setAction($action)
	{
		$this->action = $action;
	}

	public function getTemplate()
	{
		return "admin_".$this->action.".html.twig";
	}

	public function getTemplateVars()
	{
		return $this->templateVars;
	}

}
