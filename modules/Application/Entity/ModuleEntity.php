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
    protected $github_url;
    protected $is_completed;

    // Virtual Properties
    protected $comments = array();
    protected $authors = array();
    protected $screenshots = array();

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
     * @param string $author_id
     */
    public function setAuthorId($author_id)
    {
        $this->author_id = $author_id;
    }

    /**
     * @return string
     */
    public function getAuthorId()
    {
        return $this->author_id;
    }

    /**
     * @param string $author_name
     */
    public function setAuthorName($author_name)
    {
        $this->author_name = $author_name;
    }

    /**
     * @return string
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
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
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
     * @param string $last_updated
     */
    public function setLastUpdated($last_updated)
    {
        $this->last_updated = $last_updated;
    }

    /**
     * @return string
     */
    public function getLastUpdated()
    {
        return $this->last_updated;
    }

    /**
     * @param integer $num_downloads
     */
    public function setNumDownloads($num_downloads)
    {
        $this->num_downloads = $num_downloads;
    }

    /**
     * @return integer
     */
    public function getNumDownloads()
    {
        return $this->num_downloads;
    }

    /**
     * @param string $is_completed
     */
    public function setIsCompleted($is_completed)
    {
        $this->is_completed = $is_completed;
    }

    /**
     * @return string
     */
    public function getIsCompleted()
    {
        return $this->is_completed;
    }

    /**
     * Check if this entity has been completed
     *
     * @return bool
     */
    public function isCompleted()
    {
        return (bool) $this->getIsCompleted();
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
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $github_url
     */
    public function setGithubUrl($github_url)
    {
        $this->github_url = $github_url;
    }

    /**
     * @return string
     */
    public function getGithubUrl()
    {
        return $this->github_url;
    }

    public function toArray()
    {
        return get_object_vars($this);
    }

    public function toInsertArray()
    {
        $this->setNumDownloads(0);
        $vars = $this->toArray();
        unset($vars['id'], $vars['comments'], $vars['authors'], $vars['screenshots']);
        return $vars;
    }

}
