<?php

namespace App\Entity;

use App\Repository\ResourceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResourceRepository::class)]
class Resource
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'first', targetEntity: Relationship::class)]
    private Collection $relationshipsAsFirst;

    #[ORM\OneToMany(mappedBy: 'second', targetEntity: Relationship::class)]
    private Collection $relationshipsAsSecond;

    public function __construct()
    {
        $this->relationshipsAsFirst = new ArrayCollection();
        $this->relationshipsAsSecond = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Relationship>
     */
    public function getRelationshipsAsFirst(): Collection
    {
        return $this->relationshipsAsFirst;
    }

    public function addRelationshipsAsFirst(Relationship $relationshipsAsFirst): self
    {
        if (!$this->relationshipsAsFirst->contains($relationshipsAsFirst)) {
            $this->relationshipsAsFirst->add($relationshipsAsFirst);
            $relationshipsAsFirst->setFirst($this);
        }

        return $this;
    }

    public function removeRelationshipsAsFirst(Relationship $relationshipsAsFirst): self
    {
        if ($this->relationshipsAsFirst->removeElement($relationshipsAsFirst)) {
            // set the owning side to null (unless already changed)
            if ($relationshipsAsFirst->getFirst() === $this) {
                $relationshipsAsFirst->setFirst(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Relationship>
     */
    public function getRelationshipsAsSecond(): Collection
    {
        return $this->relationshipsAsSecond;
    }

    public function addRelationshipsAsSecond(Relationship $relationshipsAsSecond): self
    {
        if (!$this->relationshipsAsSecond->contains($relationshipsAsSecond)) {
            $this->relationshipsAsSecond->add($relationshipsAsSecond);
            $relationshipsAsSecond->setSecond($this);
        }

        return $this;
    }

    public function removeRelationshipsAsSecond(Relationship $relationshipsAsSecond): self
    {
        if ($this->relationshipsAsSecond->removeElement($relationshipsAsSecond)) {
            // set the owning side to null (unless already changed)
            if ($relationshipsAsSecond->getSecond() === $this) {
                $relationshipsAsSecond->setSecond(null);
            }
        }

        return $this;
    }

}
