<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class parameterApiTest extends TestCase
{
    use MakeparameterTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateparameter()
    {
        $parameter = $this->fakeparameterData();
        $this->json('POST', '/api/v1/parameters', $parameter);

        $this->assertApiResponse($parameter);
    }

    /**
     * @test
     */
    public function testReadparameter()
    {
        $parameter = $this->makeparameter();
        $this->json('GET', '/api/v1/parameters/'.$parameter->id);

        $this->assertApiResponse($parameter->toArray());
    }

    /**
     * @test
     */
    public function testUpdateparameter()
    {
        $parameter = $this->makeparameter();
        $editedparameter = $this->fakeparameterData();

        $this->json('PUT', '/api/v1/parameters/'.$parameter->id, $editedparameter);

        $this->assertApiResponse($editedparameter);
    }

    /**
     * @test
     */
    public function testDeleteparameter()
    {
        $parameter = $this->makeparameter();
        $this->json('DELETE', '/api/v1/parameters/'.$parameter->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/parameters/'.$parameter->id);

        $this->assertResponseStatus(404);
    }
}
