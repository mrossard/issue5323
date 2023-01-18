<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Link;
use App\State\RelationshipProvider;

#[ApiResource(
    operations: [
        new Get(
            uriTemplate : '/resources/{first}/relationships/{second}',
            uriVariables: [
                'first' => new Link(
                    fromProperty: 'first',
                    fromClass: Relationship::class,
                    identifiers: ['first'],
                ),
                'second' => new Link(
                    fromProperty: 'second',
                    fromClass: Relationship::class,
                    identifiers: ['second'],
                ),
            ],
        ),
        new GetCollection(
            uriTemplate : '/resources/{first}/relationships',
            uriVariables: [
                'first' => new Link(
                    fromProperty: 'first',
                    fromClass: Relationship::class,
                    identifiers: ['first'],
                ),
            ],
        ),
    ],
    provider    : RelationshipProvider::class
)]
class Relationship
{
    #[ApiProperty(identifier: true)]
    public Resource $first;
    #[ApiProperty(identifier: true)]
    public Resource $second;

    public string $someOtherStuff;

    public function __construct(Resource $first, Resource $second, string$stuff)
    {
        $this->first = $first;
        $this->second = $second;
        $this->someOtherStuff = $stuff;
    }
}