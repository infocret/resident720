<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class catmovtoApiTest extends TestCase
{
    use MakecatmovtoTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatecatmovto()
    {
        $catmovto = $this->fakecatmovtoData();
        $this->json('POST', '/api/v1/catmovtos', $catmovto);

        $this->assertApiResponse($catmovto);
    }

    /**
     * @test
     */
    public function testReadcatmovto()
    {
        $catmovto = $this->makecatmovto();
        $this->json('GET', '/api/v1/catmovtos/'.$catmovto->id);

        $this->assertApiResponse($catmovto->toArray());
    }

    /**
     * @test
     */
    public function testUpdatecatmovto()
    {
        $catmovto = $this->makecatmovto();
        $editedcatmovto = $this->fakecatmovtoData();

        $this->json('PUT', '/api/v1/catmovtos/'.$catmovto->id, $editedcatmovto);

        $this->assertApiResponse($editedcatmovto);
    }

    /**
     * @test
     */
    public function testDeletecatmovto()
    {
        $catmovto = $this->makecatmovto();
        $this->json('DELETE', '/api/v1/catmovtos/'.$catmovto->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/catmovtos/'.$catmovto->id);

        $this->assertResponseStatus(404);
    }
}
