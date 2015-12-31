<?php

namespace Application\Classes;

use Application\Entity\ModuleEntity;
use Application\Entity\ModuleScreenshotEntity;

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
        $desc = $this->getDescByModuleId($id);

        $module->setComments($comments);
        $module->setScreenshots($screenshots);
        $module->setAuthors($authors);
        $module->setDescription($desc);

        return $module;
    }

    public function updateDescription($moduleID, $desc)
    {
        return $this->moduleStorage->updateDescription($moduleID, $desc);
    }

    public function setCompleted($moduleID, $flag)
    {
        return $this->moduleStorage->setCompleted($moduleID, $flag);
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
     * @param ModuleScreenshotEntity $entity
     *
     * @return integer
     */
    public function createScreenshot(ModuleScreenshotEntity $entity)
    {
        return $this->moduleStorage->createScreenshot($entity);
    }

    /**
     * @param integer $id
     *
     * @return ModuleScreenshotEntity OR integer
     */
    public function deleteScreenshotByID($id)
    {
        return $this->moduleStorage->deleteScreenshotByID($id);
    }

    public function getDescByModuleId($id)
    {
        return $this->moduleStorage->getDescByModuleId($id);
    }


    /**
     * Get authors for a module
     *
     * @param integer $moduleID
     * @return array
     */
    public function getAuthorsByModuleID($moduleID)
    {
        return $this->moduleStorage->getAuthorsByModuleID($moduleID);
    }

    public function existsByTitle($title)
    {
        return $this->moduleStorage->existsByTitle($title);
    }

    public function create(ModuleEntity $module)
    {
        return $this->moduleStorage->create($module);
    }

    public function update(ModuleEntity $module)
    {
        return $this->moduleStorage->update($module);
    }

    public function getPopularModules()
    {
        return $this->moduleStorage->getPopularModules();
    }

    public function getUpdatedModules()
    {
        return $this->moduleStorage->getUpdatedModules();
    }

    public function searchModules($query)
    {
        return $this->moduleStorage->searchModules($query);
    }
}
