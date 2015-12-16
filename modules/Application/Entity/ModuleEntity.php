<?php

namespace Application\Entity;

class ModuleEntity
{

    protected $id;
    protected $description;
    protected $created;
    protected $last_updated;
    protected $num_downloads;
    protected $title;
    protected $author_id;
    protected $github_url;
    protected $is_completed;
    protected $num_stars;
    protected $short_description;

    // Virtual Properties
    protected $installation_details;
    protected $author_firstname;
    protected $author_lastname;
    protected $author_avatar;
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

        if($this->created !== null) {
            $this->created = new \DateTime($this->created);
        }

    }

    /**
     * @param string $details
     */
    public function setInstallationDetails($details)
    {
        $this->installation_details = $details;
    }

    /**
     * @return string
     */
    public function getInstallationDetails()
    {
        return $this->installation_details;
    }
    
    

    /**
     * @param integer $num_stars
     */
    public function setNumStars($num_stars)
    {
        $this->num_stars = $num_stars;
    }

    /**
     * @return mixed
     */
    public function getNumStars()
    {
        return $this->num_stars;
    }

    /**
     * @param string $author_id
     */
    public function setAuthorId($author_id)
    {
        $this->author_id = $author_id;
    }

    /**
     * @param mixed $short_description
     */
    public function setShortDescription($short_description)
    {
        $this->short_description = $short_description;
    }

    /**
     * @return mixed
     */
    public function getShortDescription()
    {
        return $this->short_description;
    }

    /**
     * @return string
     */
    public function getAuthorId()
    {
        return $this->author_id;
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
     * @param mixed $author_avatar
     */
    public function setAuthorAvatar($author_avatar)
    {
        $this->author_avatar = $author_avatar;
    }

    /**
     * @return mixed
     */
    public function getAuthorAvatar()
    {
        return $this->author_avatar;
    }

    /**
     * @param mixed $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $author_firstname
     */
    public function setAuthorFirstname($author_firstname)
    {
        $this->author_firstname = $author_firstname;
    }

    /**
     * @return mixed
     */
    public function getAuthorFirstname()
    {
        return $this->author_firstname;
    }

    /**
     * @param mixed $author_lastname
     */
    public function setAuthorLastname($author_lastname)
    {
        $this->author_lastname = $author_lastname;
    }

    /**
     * @return mixed
     */
    public function getAuthorLastname()
    {
        return $this->author_lastname;
    }

    public function getAuthorName()
    {
        return $this->getAuthorFirstname() . ' ' . $this->getAuthorLastname();
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
        unset(
            $vars['id'], $vars['comments'], $vars['authors'],
            $vars['screenshots'], $vars['author_firstname'], $vars['author_lastname'], $vars['author_avatar'],
            $vars['description'], $vars['installation_details']
        );
        return $vars;
    }

}
