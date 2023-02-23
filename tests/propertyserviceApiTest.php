<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class propertyserviceApiTest extends TestCase
{
    use MakepropertyserviceTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatepropertyservice()
    {
        $propertyservice = $this->fakepropertyserviceData();
        $this->json('POST', '/api/v1/propertyservices', $propertyservice);

        $this->assertApiResponse($propertyservice);
    }

    /**
     * @test
     */
    public function testReadpropertyservice()
    {
        $propertyservice = $this->makepropertyservice();
        $this->json('GET', '/api/v1/propertyservices/'.$propertyservice->id);

        $this->assertApiResponse($propertyservice->toArray());
    }

    /**
     * @test
     */
    public function testUpdatepropertyservice()
    {
        $propertyservice = $this->makepropertyservice();
        $editedpropertyservice = $this->fakepropertyserviceData();

        $this->json('PUT', '/api/v1/propertyservices/'.$propertyservice->id, $editedpropertyservice);

        $this->assertApiResponse($editedpropertyservice);
    }

    /**
     * @test
     */
    public function testDeletepropertyservice()
    {
        $propertyservice = $this->makepropertyservice();
        $this->json('DELETE', '/api/v1/propertyservices/'.$propertyservice->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/propertyservices/'.$propertyservice->id);

        $this->assertResponseStatus(404);
    }
}
