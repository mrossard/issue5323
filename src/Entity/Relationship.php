<?php

namespace App\Entity;

use App\Repository\RelationshipRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RelationshipRepository::class)]
class Relationship
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(length: 255)]
    private ?string $someOtherStuff = null;

    #[ORM\ManyToOne(inversedBy: 'relationshipsAsFirst')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Resource $first = null;

    #[ORM\ManyToOne(inversedBy: 'relationshipsAsSecond')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Resource $second = null;

    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getSomeOtherStuff(): ?string
    {
        return $this->someOtherStuff;
    }

    public function setSomeOtherStuff(string $someOtherStuff): self
    {
        $this->someOtherStuff = $someOtherStuff;

        return $this;
    }

    public function getFirst(): ?Resource
    {
        return $this->first;
    }

    public function setFirst(?Resource $first): self
    {
        $this->first = $first;

        return $this;
    }

    public function getSecond(): ?Resource
    {
        return $this->second;
    }

    public function setSecond(?Resource $second): self
    {
        $this->second = $second;

        return $this;
    }
}
