<?php

namespace App\Tests;

use ApiPlatform\Api\IriConverterInterface;
use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Relationship;
use App\Entity\Resource;
use Doctrine\ORM\EntityManagerInterface;

class RelationshipTest extends ApiTestCase
{
    private IriConverterInterface $iriConverter;
    private EntityManagerInterface $entityManager;

    function setUp(): void
    {
        self::bootKernel();
        $this->iriConverter = static::getContainer()->get(IriConverterInterface::class);
        $this->entityManager = static::getContainer()->get(EntityManagerInterface::class);
    }

    function testGetIri()
    {
        $first = $this->entityManager->find(Resource::class, 1);
        $second = $this->entityManager->find(Resource::class, 2);

        $dep = $this->entityManager->getRepository(Relationship::class)->findOneBy(
            [
                'first'=>$first,
                'second'=>$second
            ]
        );

        $iri = $this->iriConverter->getIriFromResource($dep);
        $this->assertTrue(true); //we just need the previous line not to throw an exception
    }

    public function testGetCollection(): void
    {
        $response = static::createClient()->request('GET', '/resources/1/relationships');

        $this->assertResponseIsSuccessful();
        $this->assertMatchesResourceCollectionJsonSchema(Relationship::class);
        $this->assertJsonContains(
            [
                "@context"=> "/contexts/Relationship",
                "@id"=> "/resources/1/relationships",
                "@type"=> "hydra:Collection",
                'hydra:member' => [
                    [
                        '@id' => '/resources/1/relationships/2',
                        "@type"=> "Relationship",
                        "first"=> "/resources/1",
                        'second' => '/resources/2',
                        'name' => 'first and second are related',
                    ],
                    [
                        '@id' => '/resources/1/relationships/3',
                        "@type"=> "Relationship",
                        "first"=> "/resources/1",
                        'second' => '/resources/3',
                        'name' => 'first and third are related',
                    ]
                ]
            ]
        );
    }

    public function testGetOne()
    {
        $response = static::createClient()->request(
            'GET',
            '/resources/1/relationships/2'
        );

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains(
            [
                "@context"=> "/contexts/Relationship",
                "@id"=> "/resources/1/relationships/2",
                "@type"=> "Relationship",
            ]
        );
    }
}
