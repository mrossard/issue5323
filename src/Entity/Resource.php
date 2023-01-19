<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource(
    mercure: true,
)]
#[ORM\Entity]
class Resource
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private ?int $id = null;

    #[ORM\Column]
    public string $name = '';

    public function getId(): ?int
    {
        return $this->id;
    }
}