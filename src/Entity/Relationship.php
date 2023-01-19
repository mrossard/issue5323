<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Link;
use ApiPlatform\Metadata\Post;
use App\Repository\RelationshipRepository;
use App\State\RelationshipProvider;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource(
    operations: [
        new Post(),
        new GetCollection(
            uriTemplate: '/resources/{id}/relationships',
            uriVariables: [
                'id' => new Link(
                    fromProperty: 'first',
                    fromClass   : Relationship::class,
                    identifiers : ['firstId'],
                )
            ],
            provider: RelationShipProvider::class,
        ),
        new Get(
            uriTemplate: '/resources/{firstId}/relationships/{secondId}',
            uriVariables: [
                'firstId' => new Link(
                    fromProperty: 'first',
                    fromClass   : Relationship::class,
                    identifiers : ['firstId'],
                ),
                'secondId' => new Link(
                    fromProperty: 'second',
                    fromClass   : Relationship::class,
                    identifiers : ['secondId'],
                ),
            ],
            provider: RelationShipProvider::class,
        ),
    ],
    mercure   : false
)]

#[ORM\Entity]
class Relationship
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    public string $name = '';

    #[ORM\ManyToOne(targetEntity: Resource::class)]
    #[ApiProperty(identifier: true)]
    public Resource $first;

    #[ORM\ManyToOne(targetEntity: Resource::class)]
    #[ApiProperty(identifier: true)]
    public Resource $second;

    public function getId(): string
    {
        return $this->first->getId().'-'.$this->second->getId();
    }
}