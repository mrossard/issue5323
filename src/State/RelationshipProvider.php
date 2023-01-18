<?php

namespace App\State;

use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\ApiResource\Relationship;
use App\ApiResource\Resource;
use App\Repository\RelationshipRepository;
use App\Repository\ResourceRepository;

class RelationshipProvider implements ProviderInterface
{
    public function __construct(private readonly RelationshipRepository $repository,
                                private readonly ResourceRepository $resourceRepository)
    {

    }

    /**
     * @param Operation $operation
     * @param array     $uriVariables
     * @param array     $context
     * @return object|array|null
     */
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): \Generator|Relationship|null
    {
        if($operation instanceof GetCollection) {
            $entities = $this->repository->findBy(
                [
                    'first' => $this->resourceRepository->findOneBy(['name' => $uriVariables['first']])
                ]
            );
            foreach($entities as $entity){
                yield new Relationship(
                    new Resource($entity->getFirst()->getName()),
                    new Resource($entity->getSecond()->getName()),
                    $entity->getSomeOtherStuff()
                );
            }
        }
        else{
            $entity = $this->repository->findOneBy(
                [
                    'first' => $this->resourceRepository->findOneBy(['name' => $uriVariables['first']]),
                    'second' =>$this->resourceRepository->findOneBy(['name' => $uriVariables['second']])
                ]
            );
            return new Relationship(
                new Resource($entity->getFirst()->getName()),
                new Resource($entity->getSecond()->getName()),
                $entity->getSomeOtherStuff()
            );
        }


    }
}