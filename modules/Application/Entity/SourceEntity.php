<?php

namespace Application\Entity;

class SourceEntity
{

    protected $id;
    protected $github_url;
    protected $packagist_url;

    public function __construct($data = array())
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    /**
     * @param mixed $github_url
     */
    public function setGithubUrl($github_url)
    {
        $this->github_url = $github_url;
    }

    /**
     * @return mixed
     */
    public function getGithubUrl()
    {
        return $this->github_url;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $packagist_url
     */
    public function setPackagistUrl($packagist_url)
    {
        $this->packagist_url = $packagist_url;
    }

    /**
     * @return mixed
     */
    public function getPackagistUrl()
    {
        return $this->packagist_url;
    }

}
