<?php

namespace Application\Classes;

class ModuleHelper
{

    protected $moduleStorage;

    public function setModuleStorage($storage)
    {
        $this->moduleStorage = $storage;
    }

    /**
     * Get an entity by ID
     *
     * @param integer $id
     * @return object
     */
    public function getByID($id)
    {
        $module = $this->moduleStorage->getByID($id);
        $comments = $this->getCommentsByModuleID($id);
        $screenshots = $this->getScreenshotsByModuleID($id);
		$authors = $this->getAuthorsByModuleID($id);
        $sourceInfo = $this->getSourceInfoByModuleID($id);
        
        $module->setComments($comments);
        $module->setScreenshots($screenshots);
        $module->setAuthors($authors);
        $module->setSourceInfo($sourceInfo);

        return $module;
    }

    /**
     * Get the source info for the module
     *
     * @param integer $moduleID
     */
    public function getSourceInfoByModuleID($moduleID)
    {
        return $this->moduleStorage->getSourceInfoByModuleID($moduleID);
    }

    /**
     * Get comments for a module
     *
     * @param integer $moduleID
     * @return array
     */
    public function getCommentsByModuleID($moduleID)
    {
        return $this->moduleStorage->getCommentsByModuleID($moduleID);
    }

    /**
     * Get screenshots for a module
     *
     * @param integer $moduleID
     * @return array
     */
    public function getScreenshotsByModuleID($moduleID)
    {
        return $this->moduleStorage->getScreenshotsByModuleID($moduleID);
    }

    
    /**
     * Get authors for a module
     *
     * @param integer $moduleID
     * @return array
     */    
    public function getAuthorsByModuleID($moduleID) {
    	return $this->moduleStorage->getAuthorsByModuleID($moduleID);
    }

}