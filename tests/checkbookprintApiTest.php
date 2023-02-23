<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class checkbookprintApiTest extends TestCase
{
    use MakecheckbookprintTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatecheckbookprint()
    {
        $checkbookprint = $this->fakecheckbookprintData();
        $this->json('POST', '/api/v1/checkbookprints', $checkbookprint);

        $this->assertApiResponse($checkbookprint);
    }

    /**
     * @test
     */
    public function testReadcheckbookprint()
    {
        $checkbookprint = $this->makecheckbookprint();
        $this->json('GET', '/api/v1/checkbookprints/'.$checkbookprint->id);

        $this->assertApiResponse($checkbookprint->toArray());
    }

    /**
     * @test
     */
    public function testUpdatecheckbookprint()
    {
        $checkbookprint = $this->makecheckbookprint();
        $editedcheckbookprint = $this->fakecheckbookprintData();

        $this->json('PUT', '/api/v1/checkbookprints/'.$checkbookprint->id, $editedcheckbookprint);

        $this->assertApiResponse($editedcheckbookprint);
    }

    /**
     * @test
     */
    public function testDeletecheckbookprint()
    {
        $checkbookprint = $this->makecheckbookprint();
        $this->json('DELETE', '/api/v1/checkbookprints/'.$checkbookprint->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/checkbookprints/'.$checkbookprint->id);

        $this->assertResponseStatus(404);
    }
}
