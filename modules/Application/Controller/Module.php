<?php
namespace Application\Controller;

use Application\Controller\Shared as SharedController;
use Packagist\Api\Client as PackagistClient;
use Application\Entity\ModuleEntity;

class Module extends SharedController
{
    public function viewAction($moduleId)
    {
        $selectedModule = $this->getService('module.helper')->getByID($moduleId);
        return $this->render('Application:module:view.html.php', compact('selectedModule'));
    }

    public function createAction()
    {
        $sessionModule = $this->session('wizardModule');
        $hasWizardModule = $sessionModule !== null;

        if($hasWizardModule) {
            $wizardModule = $this->getService('module.helper')->getByID($sessionModule->getID());
        }

        return $this->render('Application:module:create.html.php', compact('hasWizardModule', 'wizardModule'));
    }

    public function saveAction()
    {

        $moduleName = $this->post('moduleName');
        $githubUrl = $this->post('githubUrl');

        $response = array('status' => 'error', 'code' => 'E_ERROR', 'description' => '');

        $moduleHelper = $this->getService('module.helper');

        // Check if module exists already by its name
        if($moduleHelper->existsByTitle($moduleName)) {
            $response['status'] = 'error';
            $response['code'] = 'E_MODULE_NAME_EXISTS';
            return json_encode($response);
        }

        // Create new module entity
        $module = new ModuleEntity();
        $module->setTitle($moduleName);
        $module->setGithubUrl($githubUrl);
        $module->setAuthorID(1);

        $newModuleID = $moduleHelper->create($module);
        $module->setID($newModuleID);

        $this->getSession()->set('wizardModule', $module);

        $response['status'] = 'success';
        $response['code'] = 'OK';
        $response['description'] = 'This is a test description';
        return json_encode($response);

    }

    public function setDescAction()
    {
        $response = array('status' => 'error', 'code' => 'E_ERROR');

        $desc = $this->post('moduleDescription');
        $wizardModule = $this->session('wizardModule');
        $moduleHelper = $this->getService('module.helper');
        $result = $moduleHelper->updateDescription($wizardModule->getID(), $desc);
        if($result) {
            $response['status'] = 'success';
            $response['code'] = 'OK';
        }
        return json_encode($response);
    }

    public function finishAction()
    {
        $wizardModule = $this->session('wizardModule');
        $moduleHelper = $this->getService('module.helper');
        $moduleHelper->setCompleted($wizardModule->getID(), true);
        $this->getSession()->remove('wizardModule');
        return $this->redirectToRoute('Module_View', array('moduleId' => $wizardModule->getID()));
    }

    public function lookupPackagistAction()
    {
        $client = new PackagistClient();
        $package = $client->get($this->queryString('package'));
//        $maintainers = $package->getMaintainers();
        $desc = $package->getDescription();
        var_dump($package); exit;

        return json_encode(array(
            'desc'   => $desc,
            'status' => 'success'
        ));

    }

    /**
     * @todo - make thumbnail of original screenshot
     * @todo - move it to public DIR
     * @todo - insert record into DB
     */
    public function uploadScreenshotAction()
    {

        // @todo - lookup their temp module ID and use it for saving
        $wizardModule = $this->session('wizardModule');
        $wizardModuleID = $wizardModule->getID();

        $file = $_FILES['file'];


//        $moduleID = $this->session('wizardModule')->getID();
        $moduleID = '1';

        // Check Ext
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        if(!in_array($ext, array('png', 'jpg', 'jpeg', 'gif'))) {
            return 'E_INVALID_EXTENSION';
        }

        $config = $this->getConfig();
        $random = time(); // @todo - make this more random


        // Make the thumbnail
        $thumbFilename = sprintf('%s_thumbnail_%s.%s', $moduleID, $random, $ext);
        $thumbPath = $config['module']['thumbnails_public_dir'] . '/' . $thumbFilename;
        $this->getService('imageresize.helper')->makeThumb($file['tmp_name'], $thumbPath, 100);

        // Make the Screenshot
        $screenshotFilename = sprintf('%s_screenshot_%s.%s', $moduleID, $random, $ext);
        $screenshotPath = $config['module']['screenshots_public_dir'] . '/' . $screenshotFilename;
        $ret = move_uploaded_file($file['tmp_name'], $screenshotPath);

        die($screenshotPath);

    }
    
    function searchAction() {
        //get the query string from url
        $query = $this->getQueryString()->get('q');
        
        //get the listings based of the query 
        $listings = $this->getService('module.helper')->searchModules($query);
        
        //return the view
        return $this->render('Application:module:search.html.php', compact('query', 'listings'));
        
    }
}
