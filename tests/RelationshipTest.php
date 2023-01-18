<?php

namespace App\Tests;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\ApiResource\Relationship;

class RelationshipTest extends ApiTestCase
{
    public function testGetCollection(): void
    {
        $response = static::createClient()->request('GET', '/resources/first/relationships');

        $this->assertResponseIsSuccessful();
        $this->assertMatchesResourceCollectionJsonSchema(Relationship::class);
        $this->assertJsonContains(
            [
                "@context"=> "/contexts/Relationship",
                "@id"=> "/resources/first/relationships",
                "@type"=> "hydra:Collection",
                'hydra:member' => [
                    [
                        '@id' => '/resources/first/relationships/second',
                        "@type"=> "Relationship",
                        "first"=> "/resources/first",
                        'second' => '/resources/second',
                        'someOtherStuff' => 'first and second are related',
                    ],
                    [
                        '@id' => '/resources/first/relationships/third',
                        "@type"=> "Relationship",
                        "first"=> "/resources/first",
                        'second' => '/resources/third',
                        'someOtherStuff' => 'first and third are related',
                    ]
                ]
            ]
        );
    }

    public function testGetOne()
    {
        $response = static::createClient()->request(
            'GET',
            '/resources/first/relationships/second'
        );

        $this->assertResponseIsSuccessful();
    }
}
