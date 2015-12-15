<?php
namespace Framework;

use PPI\Framework\Module\AbstractModule;
use PPI\Framework\Autoload;


class Module extends AbstractModule
{
	
	protected $_moduleName = 'Framework';
	
	function init($e) {
		Autoload::add(__NAMESPACE__, dirname(__DIR__));
	}
	
	/**
	 * Get the routes for this module
	 * 
	 * @return \Symfony\Component\Routing\RouteCollection
	 */
	public function getRoutes() {
		return $this->loadYamlRoutes(__DIR__ . '/resources/config/routes.yml');
	}
	
}