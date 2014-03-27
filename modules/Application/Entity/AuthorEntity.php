<?php

namespace Application\Entity;

class AuthorEntity
{

    protected $id;
    protected $firstname;
    protected $lastname;
    protected $image_path;
    
    public function __construct($data = array())
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

	public function getFirstname() {
		return $this->firstname;
	}

	public function getLastname() {
		return $this->lastname;
	}
	
	public function getImagePath() {
		return $this->image_path;
	}
}
