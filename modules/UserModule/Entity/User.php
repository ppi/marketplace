<?php

namespace UserModule\Entity;

class User
{

    protected $id;
    protected $company_id;

    protected $title;
    protected $firstname;
    protected $lastname;
    protected $email;
    protected $user_level_id;
    protected $user_level_title;

    public function __construct($data = array())
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }

    }

    public function getID()
    {
        return $this->id;
    }

    public function setID($id)
    {
        $this->id = $id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getFirstName()
    {
        return $this->firstname;
    }

    public function setFirstName($fname)
    {
        $this->firstname = $fname;
    }

    public function getLastName()
    {
        return $this->lastname;
    }

    public function setLastName($lname)
    {
        $this->lastname = $lname;
    }

    public function getFullName()
    {
        return $this->getFirstName() . ' ' . $this->getLastName();
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getLevelID()
    {
        return $this->user_level_id;
    }

    public function getLevelTitle()
    {
        return $this->user_level_title;
    }

    public function getCompanyID()
    {
        return $this->company_id;
    }

}
