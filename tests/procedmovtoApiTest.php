<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class procedmovtoApiTest extends TestCase
{
    use MakeprocedmovtoTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateprocedmovto()
    {
        $procedmovto = $this->fakeprocedmovtoData();
        $this->json('POST', '/api/v1/procedmovtos', $procedmovto);

        $this->assertApiResponse($procedmovto);
    }

    /**
     * @test
     */
    public function testReadprocedmovto()
    {
        $procedmovto = $this->makeprocedmovto();
        $this->json('GET', '/api/v1/procedmovtos/'.$procedmovto->id);

        $this->assertApiResponse($procedmovto->toArray());
    }

    /**
     * @test
     */
    public function testUpdateprocedmovto()
    {
        $procedmovto = $this->makeprocedmovto();
        $editedprocedmovto = $this->fakeprocedmovtoData();

        $this->json('PUT', '/api/v1/procedmovtos/'.$procedmovto->id, $editedprocedmovto);

        $this->assertApiResponse($editedprocedmovto);
    }

    /**
     * @test
     */
    public function testDeleteprocedmovto()
    {
        $procedmovto = $this->makeprocedmovto();
        $this->json('DELETE', '/api/v1/procedmovtos/'.$procedmovto->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/procedmovtos/'.$procedmovto->id);

        $this->assertResponseStatus(404);
    }
}
