<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class serviceApiTest extends TestCase
{
    use MakeserviceTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateservice()
    {
        $service = $this->fakeserviceData();
        $this->json('POST', '/api/v1/services', $service);

        $this->assertApiResponse($service);
    }

    /**
     * @test
     */
    public function testReadservice()
    {
        $service = $this->makeservice();
        $this->json('GET', '/api/v1/services/'.$service->id);

        $this->assertApiResponse($service->toArray());
    }

    /**
     * @test
     */
    public function testUpdateservice()
    {
        $service = $this->makeservice();
        $editedservice = $this->fakeserviceData();

        $this->json('PUT', '/api/v1/services/'.$service->id, $editedservice);

        $this->assertApiResponse($editedservice);
    }

    /**
     * @test
     */
    public function testDeleteservice()
    {
        $service = $this->makeservice();
        $this->json('DELETE', '/api/v1/services/'.$service->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/services/'.$service->id);

        $this->assertResponseStatus(404);
    }
}
