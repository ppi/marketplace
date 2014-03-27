<?php

namespace Application\Entity;

class ModuleEntity
{

    protected $id;
    protected $description;
    protected $last_updated;
    protected $num_downloads;
    protected $title;
    protected $author_id;

    // Virtual Properties
    protected $comments = array();
    protected $authors = array();
    protected $screenshots = array();
    protected $sourceInfo = array();

    public function __construct($data = array())
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }

        if($this->last_updated !== null) {
            $this->last_updated = new \DateTime($this->last_updated);
        }

    }

    /**
     * @param mixed $author_id
     */
    public function setAuthorId($author_id)
    {
        $this->author_id = $author_id;
    }

    /**
     * @return mixed
     */
    public function getAuthorId()
    {
        return $this->author_id;
    }

    /**
     * @param mixed $author_name
     */
    public function setAuthorName($author_name)
    {
        $this->author_name = $author_name;
    }

    /**
     * @return mixed
     */
    public function getAuthorName()
    {
        return $this->author_name;
    }

    /**
     * @param array $comments
     */
    public function setComments(array $comments)
    {
        $this->comments = $comments;
    }
    
    /**
     * @param array $authors
     */    
    public function setAuthors(array $authors)
    {
    	$this->authors = $authors;
    }

    /**
     * @return array
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
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
     * @param mixed $last_updated
     */
    public function setLastUpdated($last_updated)
    {
        $this->last_updated = $last_updated;
    }

    /**
     * @return mixed
     */
    public function getLastUpdated()
    {
        return $this->last_updated;
    }

    /**
     * @param mixed $num_downloads
     */
    public function setNumDownloads($num_downloads)
    {
        $this->num_downloads = $num_downloads;
    }

    /**
     * @return mixed
     */
    public function getNumDownloads()
    {
        return $this->num_downloads;
    }

    /**
     * @param array $screenshots
     */
    public function setScreenshots($screenshots)
    {
        $this->screenshots = $screenshots;
    }

    /**
     * @return array
     */
    public function getScreenshots()
    {
        return $this->screenshots;
    }
    
    /**
     * @return array
     */
    public function getAuthors()
    {
    	return $this->authors;
    }
    
    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    public function setSourceInfo($sourceInfo)
    {
        $this->sourceInfo = $sourceInfo;
    }

    public function getSourceInfo()
    {
        return $this->sourceInfo;
    }


}
