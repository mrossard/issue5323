<?php

namespace App\Tests;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\ApiResource\Relationship;

class RelationshipTest extends ApiTestCase
{
    public function testSomething(): void
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
                        '@id' => '/resources/1/relationships/relatedTo.1',
                        "@type"=> "Relationship",
                        "first"=> "/resources/1",
                        'second' => '/resources/relatedTo.1',
                        'someOtherStuff' => 'whatever',
                    ]
                ]
            ]
        );
    }
}
