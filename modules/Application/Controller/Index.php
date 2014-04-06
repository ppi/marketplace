<?php
namespace Application\Controller;

use Application\Controller\Shared as SharedController;
use Packagist\Api\Client as PackagistClient;

class Index extends SharedController
{
    public function indexAction()
    {
        $moduleHelper = $this->getService('module.helper');
        $modulesList = $moduleHelper->getModulesList();

        return $this->render('Application:index:index.html.php', compact('modulesList'));
    }

}
