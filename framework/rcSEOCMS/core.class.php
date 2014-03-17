<?php
class rcSEOCMS_core {

	private $app;
	private $view;
	private $template;
	private $routes = array();
	private $page;

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
		$this->view->parserOptions = array(
			'autoescape' => false,
		);
	}
	
	private function _initRoutes()
	{
		require dirname(__FILE__)."/page.class.php";
		require dirname(__FILE__)."/admin.class.php";

		$routesData = file_get_contents(dirname(__FILE__)."/../../data/routes.dat");
		$this->routes = json_decode($routesData);

		$app = $this->app;

		foreach($this->routes as $path => $route) {		
			$page = new Page();
			$page->parse($route->uniqid);
			$this->app->get($path, function() use ($page,$app) {
				$app->render($page->getTemplate(),$page->getTemplateVars());
			});
			if($page->getType() == "contact") {
				$this->app->post($path, function() use ($page,$app) {
					$app->render($page->getSuccessTemplate(),$page->getTemplateVars());
				});
			}
			unset($page);
		}

		$admin = new Admin();
		$this->app->get("/admin", function() use ($admin,$app) {
			$admin->setAction("index");
			$app->render($admin->getTemplate(),$admin->getTemplateVars());
		});
		$this->app->get("/admin/:action", function($action) use ($admin,$app) {
			$admin->setAction($action);
			$app->render($admin->getTemplate(),$admin->getTemplateVars());
		});
		$this->app->post("/admin/:action", function($action) use ($admin,$app) {
			$admin->setAction($action);
			$app->render($admin->getTemplate(),$admin->getTemplateVars());
		});

		$this->app->notFound(function () use ($app,$_REQUEST) {
			    $app->render('404.html.twig',$_REQUEST);
		});

	}

	private function _run()
	{
		$this->app->run();
	}

}


