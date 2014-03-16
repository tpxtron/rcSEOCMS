<?php

class Page
{
	private $pageData;

	public function parsePageData($uniqid)
	{
		$fileData = file_get_contents(dirname(__FILE__)."/../../data/page_".$uniqid.".dat");

		$this->pageData = json_decode($fileData);
	}

}
