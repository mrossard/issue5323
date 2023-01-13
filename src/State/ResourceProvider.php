<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\ApiResource\Resource;
use App\Repository\ResourceRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ResourceProvider implements ProviderInterface
{

    public function __construct(private readonly ResourceRepository $repository)
    {

    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $entity = $this->repository->findOneBy([
            'name' => $uriVariables['name']
        ]);
        if(null == $entity){
            throw new NotFoundHttpException('No Resource for name '. $uriVariables['name']);
        }

        return new Resource($entity->getName());
    }
}