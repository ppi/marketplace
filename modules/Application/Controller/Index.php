<?php
namespace Application\Controller;

use Application\Controller\Shared as SharedController;
use Packagist\Api\Client as PackagistClient;

class Index extends SharedController
{
    public function indexAction()
    {
        $moduleHelper = $this->getService('module.helper');
        $popularModulesList = $moduleHelper->getPopularModules();
        $updatedModulesList = $moduleHelper->getUpdatedModules();
        return $this->render('Application:index:index.html.php', compact('popularModulesList', 'updatedModulesList'));
    }
}
