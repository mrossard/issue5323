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
                'first' => new Link(toProperty: 'first', fromClass: Resource::class),
                'second' => new Link(toProperty: 'second', fromClass: Resource::class),
            ],
        ),
        new GetCollection(
            uriTemplate : '/resources/{first}/relationships',
            uriVariables: [
                'first' => new Link(toProperty: 'first', fromClass: Resource::class),
            ],
            provider    : RelationshipProvider::class
        ),
    ]
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