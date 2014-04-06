<?php
namespace Application\Controller;

use Application\Controller\Shared as SharedController;
use Packagist\Api\Client as PackagistClient;

class Module extends SharedController
{
    public function indexAction()
    {
        $moduleID       = $this->getRouteParam('moduleID');
        $selectedModule = $this->getService('module.helper')->getByID($moduleID);
        return $this->render('Application:index:index.html.php', compact('selectedModule'));
    }

    public function createAction()
    {
        return $this->render('Application:module:create.html.php');
    }

    public function saveAction()
    {
        // @todo - setup a wizard module in the session to track their progress
        $moduleName = $this->post('moduleName');
        $githubUrl = $this->post('githubUrl');

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
}
