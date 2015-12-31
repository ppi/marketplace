<?php

namespace Application;

use PPI\Framework\Autoload;
use PPI\Framework\Module\AbstractModule;

class Module extends AbstractModule
{
    /**
     * {@inheritdoc}
     */
    public function init($e)
    {
        Autoload::add(__NAMESPACE__, dirname(__DIR__));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Application';
    }

    /**
     * Get the routes for this module
     *
     * @return \Symfony\Component\Routing\RouteCollection
     */
    public function getRoutes()
    {
        return $this->loadYamlRoutes(__DIR__ . '/resources/config/routes.yml');
    }

    /**
     * Get the configuration for this module
     *
     * @return array
     */
    public function getConfig()
    {
        return $this->loadConfig('config.php');
    }

    public function getServiceConfig()
    {
        return array('factories' => array(
            'module.helper' => function ($sm) {
                $helper = new \Application\Classes\ModuleHelper();
                $helper->setModuleStorage($sm->get('module.storage'));
                return $helper;
            },
            'imageresize.helper' => function () {
                $helper = new \Application\Classes\ImageResizeHelper();
                return $helper;
            },
            'module.storage' => function ($sm) {
                return new \Application\Storage\Module($sm->get('datasource')->getConnection('main'));
            },
        ));
    }
}
