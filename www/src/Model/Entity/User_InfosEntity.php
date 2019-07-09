<?php
namespace App\Model\Entity;

use Core\Model\Entity;

use Core\Controller\Helpers\TextController;

class User_InfosEntity extends Entity
{
    private $id;

    private $user_id;

    private $lastname;

    private $firstname;

    private $address;

    private $city;

    private $zipCode;

    private $country;

    private $phone;

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of user_id
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Get the value of name
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Get the value of slug
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Get the value of content
     */
    public function getAddress()
    {
        return $this->address;
    }

    public function getCity() {
        return $this->city;
    }

    public function getZipCode() {
        return $this->zipCode;
    }

    public function getCountry() {
        return $this->country;
    }

    public function getPhone() {
        return $this->phone;
    }
}
