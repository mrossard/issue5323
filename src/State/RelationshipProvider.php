<?php

namespace App\State;

use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Repository\RelationshipRepository;
use App\Repository\ResourceRepository;

class RelationshipProvider implements ProviderInterface
{
    public function __construct(
        private readonly RelationShipRepository $relationRepository,
        private readonly ResourceRepository $resourceRepository,
    ){

    }

    /**
     * {@inheritDoc}
     */
    public function provide(
        Operation $operation,
        array $uriVariables = [],
        array $context = [],
    ): array|object|null
    {
        if($operation instanceof GetCollection){
            return $this->relationRepository->findBy([
                'first' => $this->resourceRepository->findOneBy([
                    'id' => $uriVariables['id']
                ])
            ]);
        }

        return $this->relationRepository->findOneBy([
            'first' => $this->resourceRepository->findOneBy([
                'id' => $uriVariables['firstId']
            ]),
            'second' => $this->resourceRepository->findOneBy([
                'id' => $uriVariables['secondId']
            ]),
        ]);
    }
}