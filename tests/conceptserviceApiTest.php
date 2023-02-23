<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class conceptserviceApiTest extends TestCase
{
    use MakeconceptserviceTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateconceptservice()
    {
        $conceptservice = $this->fakeconceptserviceData();
        $this->json('POST', '/api/v1/conceptservices', $conceptservice);

        $this->assertApiResponse($conceptservice);
    }

    /**
     * @test
     */
    public function testReadconceptservice()
    {
        $conceptservice = $this->makeconceptservice();
        $this->json('GET', '/api/v1/conceptservices/'.$conceptservice->id);

        $this->assertApiResponse($conceptservice->toArray());
    }

    /**
     * @test
     */
    public function testUpdateconceptservice()
    {
        $conceptservice = $this->makeconceptservice();
        $editedconceptservice = $this->fakeconceptserviceData();

        $this->json('PUT', '/api/v1/conceptservices/'.$conceptservice->id, $editedconceptservice);

        $this->assertApiResponse($editedconceptservice);
    }

    /**
     * @test
     */
    public function testDeleteconceptservice()
    {
        $conceptservice = $this->makeconceptservice();
        $this->json('DELETE', '/api/v1/conceptservices/'.$conceptservice->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/conceptservices/'.$conceptservice->id);

        $this->assertResponseStatus(404);
    }
}
