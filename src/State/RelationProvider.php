<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\ApiResource\Relationship;
use App\ApiResource\Resource;

class RelationProvider implements ProviderInterface
{

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        return [
            new Relationship(
                new Resource($uriVariables['first']),
                new Resource('relatedTo.'.$uriVariables['first']),
                'whatever')
        ];
    }
}