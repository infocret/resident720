<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class unidadmovtoApiTest extends TestCase
{
    use MakeunidadmovtoTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateunidadmovto()
    {
        $unidadmovto = $this->fakeunidadmovtoData();
        $this->json('POST', '/api/v1/unidadmovtos', $unidadmovto);

        $this->assertApiResponse($unidadmovto);
    }

    /**
     * @test
     */
    public function testReadunidadmovto()
    {
        $unidadmovto = $this->makeunidadmovto();
        $this->json('GET', '/api/v1/unidadmovtos/'.$unidadmovto->id);

        $this->assertApiResponse($unidadmovto->toArray());
    }

    /**
     * @test
     */
    public function testUpdateunidadmovto()
    {
        $unidadmovto = $this->makeunidadmovto();
        $editedunidadmovto = $this->fakeunidadmovtoData();

        $this->json('PUT', '/api/v1/unidadmovtos/'.$unidadmovto->id, $editedunidadmovto);

        $this->assertApiResponse($editedunidadmovto);
    }

    /**
     * @test
     */
    public function testDeleteunidadmovto()
    {
        $unidadmovto = $this->makeunidadmovto();
        $this->json('DELETE', '/api/v1/unidadmovtos/'.$unidadmovto->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/unidadmovtos/'.$unidadmovto->id);

        $this->assertResponseStatus(404);
    }
}
