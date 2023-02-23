<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class propertyvalueApiTest extends TestCase
{
    use MakepropertyvalueTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatepropertyvalue()
    {
        $propertyvalue = $this->fakepropertyvalueData();
        $this->json('POST', '/api/v1/propertyvalues', $propertyvalue);

        $this->assertApiResponse($propertyvalue);
    }

    /**
     * @test
     */
    public function testReadpropertyvalue()
    {
        $propertyvalue = $this->makepropertyvalue();
        $this->json('GET', '/api/v1/propertyvalues/'.$propertyvalue->id);

        $this->assertApiResponse($propertyvalue->toArray());
    }

    /**
     * @test
     */
    public function testUpdatepropertyvalue()
    {
        $propertyvalue = $this->makepropertyvalue();
        $editedpropertyvalue = $this->fakepropertyvalueData();

        $this->json('PUT', '/api/v1/propertyvalues/'.$propertyvalue->id, $editedpropertyvalue);

        $this->assertApiResponse($editedpropertyvalue);
    }

    /**
     * @test
     */
    public function testDeletepropertyvalue()
    {
        $propertyvalue = $this->makepropertyvalue();
        $this->json('DELETE', '/api/v1/propertyvalues/'.$propertyvalue->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/propertyvalues/'.$propertyvalue->id);

        $this->assertResponseStatus(404);
    }
}
