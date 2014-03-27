<?php
namespace Application\Controller;

use Application\Controller\Shared as SharedController;


class Index extends SharedController
{
    public function indexAction()
    {

        $moduleHelper = $this->getService('module.helper');
        $selectedModule = $moduleHelper->getByID(1);

        return $this->render('Application:index:index.html.php', compact('selectedModule'));

    }
}
