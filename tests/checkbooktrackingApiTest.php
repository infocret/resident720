<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class checkbooktrackingApiTest extends TestCase
{
    use MakecheckbooktrackingTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatecheckbooktracking()
    {
        $checkbooktracking = $this->fakecheckbooktrackingData();
        $this->json('POST', '/api/v1/checkbooktrackings', $checkbooktracking);

        $this->assertApiResponse($checkbooktracking);
    }

    /**
     * @test
     */
    public function testReadcheckbooktracking()
    {
        $checkbooktracking = $this->makecheckbooktracking();
        $this->json('GET', '/api/v1/checkbooktrackings/'.$checkbooktracking->id);

        $this->assertApiResponse($checkbooktracking->toArray());
    }

    /**
     * @test
     */
    public function testUpdatecheckbooktracking()
    {
        $checkbooktracking = $this->makecheckbooktracking();
        $editedcheckbooktracking = $this->fakecheckbooktrackingData();

        $this->json('PUT', '/api/v1/checkbooktrackings/'.$checkbooktracking->id, $editedcheckbooktracking);

        $this->assertApiResponse($editedcheckbooktracking);
    }

    /**
     * @test
     */
    public function testDeletecheckbooktracking()
    {
        $checkbooktracking = $this->makecheckbooktracking();
        $this->json('DELETE', '/api/v1/checkbooktrackings/'.$checkbooktracking->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/checkbooktrackings/'.$checkbooktracking->id);

        $this->assertResponseStatus(404);
    }
}
