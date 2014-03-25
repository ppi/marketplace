<?php

namespace UserModule\Classes;

use UserModule\Entity\User as UserEntity;

class AccountHelper
{

    protected $configSalt;
    protected $uploadPath;
    protected $userStorage;
    protected $userActivationStorage;
    protected $userMetaStorage;

    public function __construct()
    {}
    
    public function setConfigSalt($salt)
    {
        $this->configSalt = $salt;
    }

    public function setUserStorage($s)
    {
        $this->userStorage = $s;
    }
    
    public function setUserActivationStorage($s)
    {
        $this->userActivationStorage= $s;
    }

    public function setUserMetaStorage($s)
    {
        $this->userMetaStorage = $s;
    }

    public function setUploadPath($path)
    {
        $this->uploadPath = $path;
    }


    /**
     * Lets create a user
     * 
     * @param \UserModule\Entity\User $userEntity
     * @return integer
     */
    public function createUser(UserEntity $userEntity)
    {
        $configSalt = $this->configSalt;
        return $this->userStorage->insert(array(
            'firstname' => $userEntity->getFirstName(),
            'lastname'  => $userEntity->getLastName(),
            'email'     => $userEntity->getEmail(),
            'password'  => $userEntity->getPassword(),
            'salt'      => $userEntity->getSalt()
        ), $configSalt);
    }

    /**
     * Get a user by ID
     * 
     * @param integer $id
     * @return object
     */
    public function getUserByID($id)
    {
        return $this->userStorage->getByID($id);
    }

    /**
     * Create a user activation record
     * 
     * @param \UserModule\Entity\User $user
     * @return mixed
     */
    public function createUserActivation(UserEntity $user)
    {
        $token = sha1(openssl_random_pseudo_bytes(16));
        $date  = date('Y-m-d H:i:s');
        return $this->userActivationStorage->insert(array(
            'user_id'   => $user->getID(),
            'date_used' => $date,
            'token'     => $token
        ));
    }

    /**
     * Activate the user by their token
     * 
     * @param string $token
     * @return mixed
     */
    public function activateUserByToken($token)
    {
        return $this->userActivationStorage->activateUserByToken($token);
    }

    /**
     * Check if this token is valid to be activated
     * 
     * @param string $token
     * @return bool
     */
    public function isValidActivationToken($token)
    {
        // Check if it exist and has not been used before.
        return $this->userActivationStorage->existsByToken($token) 
            && !$this->userActivationStorage->tokenHasBeenUsed($token);
    }

    /**
     * Get the user ID attached to an activation record
     * 
     * @param string $token
     * @return integer
     */
    public function getUserIDFromActivationToken($token)
    {
        return $this->userActivationStorage->getUserIDFromToken($token);
    }
    
    /**
     * Delete a user and all their dependencies
     */
    public function deleteUser($userID)
    {
        // Wipe the user record
        $this->userStorage->deleteByID($userID);
        
        // Wipe data from meta data, gallery, music, video
        $this->userMetaStorage->deleteByUserID($userID);

    }

    /**
     * Normalise a username, removing characters which are not a-z, 0-9, 
     * 
     * @param string  $string
     * @param boolean $lowerCase
     * @return mixed
     */
    public function normaliseUserName($string, $lowerCase = true)
    {
        $string = preg_replace("/[^A-Za-z0-9\._]/", '', $string);
        return $lowerCase ? strtolower($string) : $string;
    }
    
    public function existsByEmail($email)
    {
        return $this->userStorage->existsByEmail($email);
    }
    
}