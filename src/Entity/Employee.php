<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EmployeeRepository")
 */
class Employee extends User
{
    /**
     * @var string
     *
     * @ORM\Column(length=255)
     *
     * @Assert\Length(max="255")
     */
    protected $firstName;

    /**
     * @var string
     *
     * @ORM\Column(length=255)
     *
     * @Assert\Length(max="255")
     */
    protected $lastName;

    /**
     * @var string
     *
     * @ORM\Column(length=64)
     *
     * @Assert\Length(max="64")
     */
    protected $phone;

    /**
     * @return string
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function getRoles()
    {
        return ['ROLE_EMPLOYEE'];
    }
}