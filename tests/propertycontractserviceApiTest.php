<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class propertycontractserviceApiTest extends TestCase
{
    use MakepropertycontractserviceTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatepropertycontractservice()
    {
        $propertycontractservice = $this->fakepropertycontractserviceData();
        $this->json('POST', '/api/v1/propertycontractservices', $propertycontractservice);

        $this->assertApiResponse($propertycontractservice);
    }

    /**
     * @test
     */
    public function testReadpropertycontractservice()
    {
        $propertycontractservice = $this->makepropertycontractservice();
        $this->json('GET', '/api/v1/propertycontractservices/'.$propertycontractservice->id);

        $this->assertApiResponse($propertycontractservice->toArray());
    }

    /**
     * @test
     */
    public function testUpdatepropertycontractservice()
    {
        $propertycontractservice = $this->makepropertycontractservice();
        $editedpropertycontractservice = $this->fakepropertycontractserviceData();

        $this->json('PUT', '/api/v1/propertycontractservices/'.$propertycontractservice->id, $editedpropertycontractservice);

        $this->assertApiResponse($editedpropertycontractservice);
    }

    /**
     * @test
     */
    public function testDeletepropertycontractservice()
    {
        $propertycontractservice = $this->makepropertycontractservice();
        $this->json('DELETE', '/api/v1/propertycontractservices/'.$propertycontractservice->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/propertycontractservices/'.$propertycontractservice->id);

        $this->assertResponseStatus(404);
    }
}
