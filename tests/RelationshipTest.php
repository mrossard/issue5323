<?php

namespace App\Tests;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Relationship;

class RelationshipTest extends ApiTestCase
{
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
