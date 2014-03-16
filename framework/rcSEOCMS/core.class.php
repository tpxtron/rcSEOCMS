<?php
class rcSEOCMS_core {

	private $app;
	private $view;
	private $template;
	private $routes = array();
	private $page;
	private $pageVars = array();

	public function run()
	{
		$this->_init();
		$this->_run();
	}

	private function _init()
	{
		$this->_initApp();
		$this->_initView();
		$this->_initRoutes();
	}

	private function _initApp()
	{
		require dirname(__FILE__)."/../Slim/Slim.php";
		\Slim\Slim::registerAutoloader();

		$this->app = new \Slim\Slim();	
		$this->app->config(array(
			'view' => new \Slim\Views\Twig(),
			'templates.path' => dirname(__FILE__).'/../../templates/'
		));
	}

	private function _initView()
	{
		$this->view = $this->app->view();
		$this->view->parserExtensions = array(
			new \Slim\Views\TwigExtension(),
		);
	}
	
	private function _initRoutes()
	{
		require dirname(__FILE__)."/page.class.php";

		$routesData = file_get_contents(dirname(__FILE__)."/../../data/routes.dat");
		$this->routes = json_decode($routesData);

		foreach($this->routes as $path => $route) {
			var_dump($route);
		}
		$page = new Page();
/*
		$app->get('/', function() use ($app) {
			$tpl = "template_index.html.twig";
			$app->render($tpl);
		});
 */
		$app = $this->app;
		$pageVars = $this->pageVars;
		$this->app->notFound(function () use ($app,$pageVars) {
			    $app->render('404.html.twig',$pageVars);
		});

	}

	private function _run()
	{
		$this->app->run();
	}

}


