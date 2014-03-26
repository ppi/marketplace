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

        $module->setComments($comments);
        $module->setScreenshots($screenshots);

        return $module;
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

}