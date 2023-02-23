<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class propertyareasApiTest extends TestCase
{
    use MakepropertyareasTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatepropertyareas()
    {
        $propertyareas = $this->fakepropertyareasData();
        $this->json('POST', '/api/v1/propertyareas', $propertyareas);

        $this->assertApiResponse($propertyareas);
    }

    /**
     * @test
     */
    public function testReadpropertyareas()
    {
        $propertyareas = $this->makepropertyareas();
        $this->json('GET', '/api/v1/propertyareas/'.$propertyareas->id);

        $this->assertApiResponse($propertyareas->toArray());
    }

    /**
     * @test
     */
    public function testUpdatepropertyareas()
    {
        $propertyareas = $this->makepropertyareas();
        $editedpropertyareas = $this->fakepropertyareasData();

        $this->json('PUT', '/api/v1/propertyareas/'.$propertyareas->id, $editedpropertyareas);

        $this->assertApiResponse($editedpropertyareas);
    }

    /**
     * @test
     */
    public function testDeletepropertyareas()
    {
        $propertyareas = $this->makepropertyareas();
        $this->json('DELETE', '/api/v1/propertyareas/'.$propertyareas->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/propertyareas/'.$propertyareas->id);

        $this->assertResponseStatus(404);
    }
}
