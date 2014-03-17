<?php

class Page
{
	private $pageData;
	private $config;

	public function parseConfig()
	{
		$this->configData = parse_ini_file(dirname(__FILE__)."/../../config.ini",true);
	}

	public function parse($uniqid)
	{
		$fileData = file_get_contents(dirname(__FILE__)."/../../data/page_".$uniqid.".dat");
		$this->pageData = json_decode($fileData);
	}

	public function getTemplate()
	{
		switch($this->pageData->config->type) {
			case 'index':
				return "template_index.html.twig";
				break;
			case 'contact':
				return "template_contact.html.twig";
				break;
			default:
				return "template_default.html.twig";
				break;
		}
	}

	public function getType()
	{
		return $this->pageData->config->type;
	}

	public function getSuccessTemplate()
	{
		return "template_contact_success.html.twig";
	}

	public function getTemplateVars()
	{
		$this->parseConfig();

		$templateVars = array();

		if(isset($this->pageData->page) && is_array($this->pageData->page))	{
			$templateVars["page"] = array_merge($this->configData['page'], $this->pageData->page);
		} else {
			$templateVars["page"] = $this->configData['page'];
		}
		if(isset($this->pageData->headline)) $templateVars["headline"] = $this->pageData->headline;
		if(isset($this->pageData->intro)) $templateVars["intro"] = $this->pageData->intro;
		if(isset($this->pageData->panels)) $templateVars["panels"] = $this->pageData->panels;

		require dirname(__FILE__)."/menu.class.php";
		$menu = new Menu();
		$templateVars["menu"] = $menu->getMenu();

		return $templateVars;
	}

}
