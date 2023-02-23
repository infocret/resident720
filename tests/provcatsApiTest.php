<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class provcatsApiTest extends TestCase
{
    use MakeprovcatsTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateprovcats()
    {
        $provcats = $this->fakeprovcatsData();
        $this->json('POST', '/api/v1/provcats', $provcats);

        $this->assertApiResponse($provcats);
    }

    /**
     * @test
     */
    public function testReadprovcats()
    {
        $provcats = $this->makeprovcats();
        $this->json('GET', '/api/v1/provcats/'.$provcats->id);

        $this->assertApiResponse($provcats->toArray());
    }

    /**
     * @test
     */
    public function testUpdateprovcats()
    {
        $provcats = $this->makeprovcats();
        $editedprovcats = $this->fakeprovcatsData();

        $this->json('PUT', '/api/v1/provcats/'.$provcats->id, $editedprovcats);

        $this->assertApiResponse($editedprovcats);
    }

    /**
     * @test
     */
    public function testDeleteprovcats()
    {
        $provcats = $this->makeprovcats();
        $this->json('DELETE', '/api/v1/provcats/'.$provcats->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/provcats/'.$provcats->id);

        $this->assertResponseStatus(404);
    }
}
