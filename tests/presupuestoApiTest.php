<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class presupuestoApiTest extends TestCase
{
    use MakepresupuestoTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatepresupuesto()
    {
        $presupuesto = $this->fakepresupuestoData();
        $this->json('POST', '/api/v1/presupuestos', $presupuesto);

        $this->assertApiResponse($presupuesto);
    }

    /**
     * @test
     */
    public function testReadpresupuesto()
    {
        $presupuesto = $this->makepresupuesto();
        $this->json('GET', '/api/v1/presupuestos/'.$presupuesto->id);

        $this->assertApiResponse($presupuesto->toArray());
    }

    /**
     * @test
     */
    public function testUpdatepresupuesto()
    {
        $presupuesto = $this->makepresupuesto();
        $editedpresupuesto = $this->fakepresupuestoData();

        $this->json('PUT', '/api/v1/presupuestos/'.$presupuesto->id, $editedpresupuesto);

        $this->assertApiResponse($editedpresupuesto);
    }

    /**
     * @test
     */
    public function testDeletepresupuesto()
    {
        $presupuesto = $this->makepresupuesto();
        $this->json('DELETE', '/api/v1/presupuestos/'.$presupuesto->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/presupuestos/'.$presupuesto->id);

        $this->assertResponseStatus(404);
    }
}
