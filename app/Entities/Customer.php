<?php

namespace App\Entities;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name = "customers", uniqueConstraints={@UniqueConstraint(columns={"email"})})
 */
class Customer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="bigint")
     */
    protected $id = null;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected string $first_name;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected string $last_name;

    /**
     * @ORM\Column(type="string", unique=true, nullable=false)
     */
    protected string $email;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected string $country;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected string $username;

    /**
     * @ORM\Column(type="string")
     */
    protected string $password;

    /**
     * @ORM\Column(type="string", length=50,  columnDefinition="ENUM('male', 'female')"))
     */
    protected string $gender;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected string $city;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected string $phone;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    public function __construct(
        string $firstName,
        string $lastName,
        string $email,
        string $country,
        string $username,
        string $password,
        string $gender,
        string $city,
        string $phone
    ) {
        $this->first_name = $firstName;
        $this->last_name = $lastName;
        $this->email = $email;
        $this->country = $country;
        $this->username = $username;
        $this->password = $password;
        $this->gender = $gender;
        $this->city = $city;
        $this->phone = $phone;
    }


    /**
     *  set password hash
     */
    private function setPasswordHash()
    {
        $this->password = md5($this->password);
    }

    public function getFullName()
    {
        return $this->first_name . " ". $this->last_name;
    }

    public function list()
    {
        return [
            'full_name' => $this->first_name . " ". $this->last_name,
            'email' => $this->email,
            'country' => $this->country
        ];
    }

    public function showIdInfo()
    {
        return [
            'full_name' => $this->first_name . " ". $this->last_name,
            'email' => $this->email,
            'username' => $this->username,
            'gender' => $this->gender,
            'country' => $this->country,
            'city' => $this->city,
            'phone' => $this->phone
        ];

    }


}
