<?php
namespace Application\Controller;

use Application\Controller\Shared as SharedController;
use Packagist\Api\Client as PackagistClient;

class Index extends SharedController
{
    public function indexAction()
    {

        $moduleHelper = $this->getService('module.helper');
        $selectedModule = $moduleHelper->getByID(1);

        return $this->render('Application:index:index.html.php', compact('selectedModule'));
    }

    public function createModuleAction()
    {
        return $this->render('Application:index:createmodule.html.php');
    }

    public function lookupPackagistAction()
    {
        $client = new PackagistClient();
        $package = $client->get($this->queryString('package'));
//        $maintainers = $package->getMaintainers();
        $desc = $package->getDescription();

        return json_encode(array(
            'desc'   => $desc,
            'status' => 'success'
        ));

    }
}
