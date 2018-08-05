<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 */
class Project
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date", nullable=false)
     *
     * @Assert\NotBlank()
     */
    protected $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date", nullable=false)
     *
     * @Assert\NotBlank()
     */
    protected $endDate;

    /**
     * @var Turbine
     *
     * @ORM\ManyToOne(targetEntity="Turbine")
     */
    protected $turbine;

    /**
     * @var Employee[]|Collection
     *
     * @ORM\ManyToMany(targetEntity="Employee", inversedBy="projects", fetch="EXTRA_LAZY")
     */
    protected $employees;

    public function __construct()
    {
        $this->employees = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getTurbine() ? sprintf(
            '%s (%s - %s)',
            $this->getTurbine(),
            $this->getStartDate()->format('Y-m-d'),
            $this->getEndDate()->format('Y-m-d')
            ) : '';
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getStartDate(): ?\DateTime
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTime $startDate): void
    {
        $this->startDate = $startDate;
    }

    public function getEndDate(): ?\DateTime
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTime $endDate): void
    {
        $this->endDate = $endDate;
    }

    public function getTurbine(): ?Turbine
    {
        return $this->turbine;
    }

    public function setTurbine(Turbine $turbine): void
    {
        $this->turbine = $turbine;
    }

    /**
     * @return Employee[]|Collection
     */
    public function getEmployees(): Collection
    {
        return $this->employees;
    }

    public function addEmployee(Employee $employee): void
    {
        $this->employees->add($employee);
        $employee->addProject($this);
    }

    public function removeEmployee(Employee $employee): void
    {
        if ($this->employees->contains($employee)) {
            $this->employees->removeElement($employee);
            $employee->removeProject($this);
        }
    }
}