<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class propertyparameterApiTest extends TestCase
{
    use MakepropertyparameterTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatepropertyparameter()
    {
        $propertyparameter = $this->fakepropertyparameterData();
        $this->json('POST', '/api/v1/propertyparameters', $propertyparameter);

        $this->assertApiResponse($propertyparameter);
    }

    /**
     * @test
     */
    public function testReadpropertyparameter()
    {
        $propertyparameter = $this->makepropertyparameter();
        $this->json('GET', '/api/v1/propertyparameters/'.$propertyparameter->id);

        $this->assertApiResponse($propertyparameter->toArray());
    }

    /**
     * @test
     */
    public function testUpdatepropertyparameter()
    {
        $propertyparameter = $this->makepropertyparameter();
        $editedpropertyparameter = $this->fakepropertyparameterData();

        $this->json('PUT', '/api/v1/propertyparameters/'.$propertyparameter->id, $editedpropertyparameter);

        $this->assertApiResponse($editedpropertyparameter);
    }

    /**
     * @test
     */
    public function testDeletepropertyparameter()
    {
        $propertyparameter = $this->makepropertyparameter();
        $this->json('DELETE', '/api/v1/propertyparameters/'.$propertyparameter->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/propertyparameters/'.$propertyparameter->id);

        $this->assertResponseStatus(404);
    }
}
