<?php

namespace Application\Entity;

class ModuleInstallationEntity
{

    protected $id;
    protected $module_id;
    protected $content;

    public function __construct($data = array())
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }

        if($this->created !== null) {
            $this->created = new \DateTime($this->created);
        }

    }

    /**
     * @param integer $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return integer
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param integer $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return integer
     */
    public function getCreated()
    {
        return $this->created;
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

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

}
