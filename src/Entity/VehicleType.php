<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VehicleTypeRepository")
 */
class VehicleType
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=65535)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Make", mappedBy="type")
     */
    private $makes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Model", mappedBy="type")
     */
    private $models;

    public function __construct()
    {
        $this->makes = new ArrayCollection();
        $this->models = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Make[]
     */
    public function getMakes(): Collection
    {
        return $this->makes;
    }

    public function addMake(Make $make): self
    {
        if (!$this->makes->contains($make)) {
            $this->makes[] = $make;
            $make->setType($this);
        }

        return $this;
    }

    public function removeMake(Make $make): self
    {
        if ($this->makes->contains($make)) {
            $this->makes->removeElement($make);
            // set the owning side to null (unless already changed)
            if ($make->getType() === $this) {
                $make->setType(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Model[]
     */
    public function getModels(): Collection
    {
        return $this->models;
    }

    public function addModel(Model $model): self
    {
        if (!$this->models->contains($model)) {
            $this->models[] = $model;
            $model->setType($this);
        }

        return $this;
    }

    public function removeModel(Model $model): self
    {
        if ($this->models->contains($model)) {
            $this->models->removeElement($model);
            // set the owning side to null (unless already changed)
            if ($model->getType() === $this) {
                $model->setType(null);
            }
        }

        return $this;
    }
}
