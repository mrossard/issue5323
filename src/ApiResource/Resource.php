<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use App\State\ResourceProvider;

#[ApiResource(
    operations: [
        new Get(
            uriTemplate: '/resources/{name}',
            provider   : ResourceProvider::class
        ),
    ]
)]
class Resource
{
    #[ApiProperty(identifier: true)]
    public string $name;

    public function __construct($name)
    {
        $this->name = $name;
    }
}