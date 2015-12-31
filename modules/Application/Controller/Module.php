<?php
namespace Application\Controller;

use Application\Controller\Shared as SharedController;
use Application\Entity\ModuleScreenshotEntity;
use Application\Entity\ModuleEntity;
use Packagist\Api\Client as PackagistClient;
use Psr\Http\Message\RequestInterface;

class Module extends SharedController
{
    public function viewAction(RequestInterface $request)
    {
        /**
         * @todo - Check user is logged in - if they are logged in and module is theirs show edit
         */
        $moduleId = $request->get('moduleId');
        $selectedModule = $this->getService('module.helper')->getByID($moduleId);
        $moduleOwner = true; // @todo - make dynamic
        return $this->render('Application:module:view.html.php', compact('selectedModule', 'moduleOwner'));
    }

    public function createAction()
    {
        /**
         * @todo - Check user is logged in
         */

        $sessionModule = $this->session('wizardModule');
        $hasWizardModule = $sessionModule !== null;

        if ($hasWizardModule) {
            $wizardModule = $this->getService('module.helper')->getByID($sessionModule->getID());
        }

        return $this->render('Application:module:create.html.php', compact('hasWizardModule', 'wizardModule'));
    }

    public function editAction(RequestInterface $request)
    {
        /**
         * @todo - Check user is logged in
         * @todo - Check module is assigned to logged in user
         */

        $moduleId = $request->get('moduleId');

        $wizardModule = $this->getService('module.helper')->getByID($moduleId);

        $config = $this->getConfig();

        return $this->render('Application:module:edit.html.php', compact('wizardModule', 'config', 'moduleId'));
    }

    public function saveInformationAction(RequestInterface $request)
    {
        /**
         * @todo - Check user is logged in
         * @todo - Check module is assigned to logged in user
         */
        $moduleId   = $request->get('moduleId', 0);
        $moduleName = $request->get('moduleName');
        $githubUrl  = $request->get('githubUrl');

        $response = array(
            'status'      => 'error',
            'code'        => 'E_ERROR',
            'description' => ''
        );

        $moduleHelper = $this->getService('module.helper');
        $module = null;

        if ($moduleId==0) {
            // Check if module exists already by its name
            if ($moduleHelper->existsByTitle($moduleName)) {
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

        } else {
            $module = $moduleHelper->getByID($moduleId);
            $module->setTitle($moduleName);
            $module->setGithubUrl($githubUrl);
            $moduleHelper->update($module);
        }

        $this->getSession()->set('wizardModule', $module);

        $response['status'] = 'success';
        $response['code'] = 'OK';
        $response['description'] = $module->getDescription();

        return json_encode($response);
    }

    public function saveDescriptionAction(RequestInterface $request)
    {
        /**
         * @todo - Check user is logged in
         * @todo - Check module is assigned to logged in user
         */

        $response = array('status' => 'error', 'code' => 'E_ERROR');

        $desc = $this->post('moduleDescription');
        $wizardModule = $this->session('wizardModule');
        $moduleHelper = $this->getService('module.helper');
        $result = $moduleHelper->updateDescription($wizardModule->getID(), $desc);
        if ($result) {
            $response['status'] = 'success';
            $response['code'] = 'OK';
        }
        return json_encode($response);
    }

    public function saveFinishAction(RequestInterface $request)
    {
        /**
         * @todo - Check user is logged in
         * @todo - Check module is assigned to logged in user
         */

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
        //$maintainers = $package->getMaintainers();
        $desc = $package->getDescription();

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
    public function saveScreenshotsAction(RequestInterface $request)
    {
        /**
         * @todo - Check user is logged in
         * @todo - Check module is assigned to logged in user
         */

        // Get the moduleId from session
        $moduleID = $this->session('wizardModule')->getID();

        $file = array();

        if ($request->files->has('file')) {
            $file = $request->files->get('file');
        } else {
            return 'E_FILE_NOT_FOUND';
        }

        // Check File Extension
        $ext = $file->guessExtension();
        if (!in_array($ext, array('png', 'jpg', 'jpeg'))) {
            return 'E_INVALID_EXTENSION';
        }

        // Check max file size

        if ($file->getClientSize() > $file::getMaxFilesize()) {
            return 'E_MAX_FILE_SIZE_EXCEEDED';
        }

        $config = $this->getConfig();

        // Make random integer length - 10
        $random = '';
        for ($i = 0; $i < 9; $i++) {
            $random .= mt_rand(0, 9);
        }

        // Make the Thumbnail
        $thumbFilename = sprintf('%s_thumbnail_%s.%s', $moduleID, $random, $ext);

        $thumbPath = $config['module']['thumbnails_public_dir'] . '/' . $thumbFilename;
        $thumbWidth = $config['module']['thumbnails_width'];

        $this->getService('imageresize.helper')->makeThumb($file->getPathname(), $thumbPath, $thumbWidth);

        // Make the Screenshot
        $screenshotFilename = sprintf('%s_screenshot_%s.%s', $moduleID, $random, $ext);

        $file->move($config['module']['screenshots_public_dir'], $screenshotFilename);

        $screenshotEntity = new ModuleScreenshotEntity();
        $screenshotEntity->setModuleId($moduleID);
        $screenshotEntity->setPath($screenshotFilename);
        $screenshotEntity->setThumbPath($thumbFilename);

        $this->getService('module.helper')->createScreenshot($screenshotEntity);

        return json_encode([
            'status' => 'success',
            'data' => $screenshotEntity->toArray()
        ]);
    }

    public function deleteScreenshotAction(RequestInterface $request)
    {
        /**
         * @todo - Check user is logged in
         * @todo - Check module is assigned to logged in user
         */

        $moduleId = $request->get('moduleId');
        $screenshotId = $request->get('screenshotId');

        // Delete and return the deleted screenshot
        $deletedScreenshot = $this->getService('module.helper')->deleteScreenshotByID($screenshotId);

        if ($deletedScreenshot!==false) {
            // Delete screenshot and thumbnail from the file directory
            $config = $this->getConfig();
            $hasScreenshotDeleted = unlink($config['module']['screenshots_public_dir'] . DS . $deletedScreenshot->getPath());
            $hasThumbDeleted = unlink($config['module']['thumbnails_public_dir'] . DS . $deletedScreenshot->getThumbPath());
            if ($hasScreenshotDeleted === false || $hasThumbDeleted === false) {
                return json_encode([
                    'status' => 'error',
                    'code'   => 'E_FILES_NOT_DELETED'
                ]);
            }
        } else {
            return json_encode([
                'status' => 'error',
                'code'   => 'E_DATABASE_AND_FILES_NOT_DELETED'
            ]);
        }

        $screenshots = $this->getService('module.helper')->getScreenshotsByModuleID($moduleId);

        return json_encode([
            'status' => 'success',
            'html'   => $this->render('Application:module:screenshots.html.php', compact('screenshots', 'moduleId'))
        ]);
    }

    public function searchAction()
    {
        //get the query string from url``
        $query = $this->getQueryString()->get('q');

        //get the listings based of the query
        $listings = $this->getService('module.helper')->searchModules($query);

        //return the view
        return $this->render('Application:module:search.html.php', compact('query', 'listings'));
    }
}
