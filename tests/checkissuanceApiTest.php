<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class checkissuanceApiTest extends TestCase
{
    use MakecheckissuanceTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatecheckissuance()
    {
        $checkissuance = $this->fakecheckissuanceData();
        $this->json('POST', '/api/v1/checkissuances', $checkissuance);

        $this->assertApiResponse($checkissuance);
    }

    /**
     * @test
     */
    public function testReadcheckissuance()
    {
        $checkissuance = $this->makecheckissuance();
        $this->json('GET', '/api/v1/checkissuances/'.$checkissuance->id);

        $this->assertApiResponse($checkissuance->toArray());
    }

    /**
     * @test
     */
    public function testUpdatecheckissuance()
    {
        $checkissuance = $this->makecheckissuance();
        $editedcheckissuance = $this->fakecheckissuanceData();

        $this->json('PUT', '/api/v1/checkissuances/'.$checkissuance->id, $editedcheckissuance);

        $this->assertApiResponse($editedcheckissuance);
    }

    /**
     * @test
     */
    public function testDeletecheckissuance()
    {
        $checkissuance = $this->makecheckissuance();
        $this->json('DELETE', '/api/v1/checkissuances/'.$checkissuance->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/checkissuances/'.$checkissuance->id);

        $this->assertResponseStatus(404);
    }
}
