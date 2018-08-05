<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @var Project[]|Collection
     *
     * @ORM\ManyToMany(targetEntity="Project", mappedBy="employees", fetch="EXTRA_LAZY")
     */
    protected $projects;

    public function __construct()
    {
        parent::__construct();

        $this->projects = new ArrayCollection();
    }

    public function __toString()
    {
        return sprintf('%s %s', $this->getFirstName(), $this->getLastName());
    }

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

    public function addProject(Project $project): void
    {
        $this->projects->add($project);
    }

    public function removeProject(Project $project): void
    {
        if ($this->projects->contains($project)) {
            $this->projects->removeElement($project);
        }
    }

    /**
     * @return Project[]|Collection
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function getRoles()
    {
        return ['ROLE_EMPLOYEE'];
    }
}