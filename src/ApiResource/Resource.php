<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use App\State\ResourceProvider;

#[ApiResource(
    operations: [
        new Get(
            uriTemplate: '/resources/{id}',
            provider   : ResourceProvider::class
        ),
    ]
)]
class Resource
{
    #[ApiProperty(identifier: true)]
    public string $id;

    public string $name;

    public function __construct($id)
    {
        $this->id = $id;
        $this->name = 'Ressource#'.$id;
    }
}