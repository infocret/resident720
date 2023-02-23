<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class providersApiTest extends TestCase
{
    use MakeprovidersTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateproviders()
    {
        $providers = $this->fakeprovidersData();
        $this->json('POST', '/api/v1/providers', $providers);

        $this->assertApiResponse($providers);
    }

    /**
     * @test
     */
    public function testReadproviders()
    {
        $providers = $this->makeproviders();
        $this->json('GET', '/api/v1/providers/'.$providers->id);

        $this->assertApiResponse($providers->toArray());
    }

    /**
     * @test
     */
    public function testUpdateproviders()
    {
        $providers = $this->makeproviders();
        $editedproviders = $this->fakeprovidersData();

        $this->json('PUT', '/api/v1/providers/'.$providers->id, $editedproviders);

        $this->assertApiResponse($editedproviders);
    }

    /**
     * @test
     */
    public function testDeleteproviders()
    {
        $providers = $this->makeproviders();
        $this->json('DELETE', '/api/v1/providers/'.$providers->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/providers/'.$providers->id);

        $this->assertResponseStatus(404);
    }
}
