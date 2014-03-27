<?php

namespace Application\Entity;

class ModuleScreenshotEntity
{

    protected $id;
    protected $module_id;
    protected $path;
    protected $thumb_path;

    public function __construct($data = array())
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    /**
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $module_id
     */
    public function setModuleId($module_id)
    {
        $this->module_id = $module_id;
    }

    /**
     * @return integer
     */
    public function getModuleId()
    {
        return $this->module_id;
    }

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    public function getThumbPath()
    {
        return $this->thumb_path;
    }

    public function setThumbPath($path)
    {
        $this->thumb_path = $path;
    }

    

}
