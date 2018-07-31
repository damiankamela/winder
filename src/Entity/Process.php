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
 * @UniqueEntity(fields={"name"})
 */
class Process
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
     * @var string
     *
     * @ORM\Column(length=255)
     *
     * @Assert\NotBlank()
     */
    protected $name;

    /**
     * @var Turbine
     *
     * @ORM\ManyToOne(targetEntity="Turbine", inversedBy="processes")
     */
    protected $turbine;

    /**
     * @var Stage[]|Collection
     *
     * @ORM\OneToMany(targetEntity="Stage", mappedBy="process", fetch="EXTRA_LAZY")
     */
    protected $stages;

    public function __construct()
    {
        $this->stages = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name ?? '';
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
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
     * @return Stage[]|Collection
     */
    public function getStages(): Collection
    {
        return $this->stages;
    }
}