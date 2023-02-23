<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class movimientoTipoApiTest extends TestCase
{
    use MakemovimientoTipoTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatemovimientoTipo()
    {
        $movimientoTipo = $this->fakemovimientoTipoData();
        $this->json('POST', '/api/v1/movimientoTipos', $movimientoTipo);

        $this->assertApiResponse($movimientoTipo);
    }

    /**
     * @test
     */
    public function testReadmovimientoTipo()
    {
        $movimientoTipo = $this->makemovimientoTipo();
        $this->json('GET', '/api/v1/movimientoTipos/'.$movimientoTipo->id);

        $this->assertApiResponse($movimientoTipo->toArray());
    }

    /**
     * @test
     */
    public function testUpdatemovimientoTipo()
    {
        $movimientoTipo = $this->makemovimientoTipo();
        $editedmovimientoTipo = $this->fakemovimientoTipoData();

        $this->json('PUT', '/api/v1/movimientoTipos/'.$movimientoTipo->id, $editedmovimientoTipo);

        $this->assertApiResponse($editedmovimientoTipo);
    }

    /**
     * @test
     */
    public function testDeletemovimientoTipo()
    {
        $movimientoTipo = $this->makemovimientoTipo();
        $this->json('DELETE', '/api/v1/movimientoTipos/'.$movimientoTipo->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/movimientoTipos/'.$movimientoTipo->id);

        $this->assertResponseStatus(404);
    }
}
