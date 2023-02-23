<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class checkbookApiTest extends TestCase
{
    use MakecheckbookTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatecheckbook()
    {
        $checkbook = $this->fakecheckbookData();
        $this->json('POST', '/api/v1/checkbooks', $checkbook);

        $this->assertApiResponse($checkbook);
    }

    /**
     * @test
     */
    public function testReadcheckbook()
    {
        $checkbook = $this->makecheckbook();
        $this->json('GET', '/api/v1/checkbooks/'.$checkbook->id);

        $this->assertApiResponse($checkbook->toArray());
    }

    /**
     * @test
     */
    public function testUpdatecheckbook()
    {
        $checkbook = $this->makecheckbook();
        $editedcheckbook = $this->fakecheckbookData();

        $this->json('PUT', '/api/v1/checkbooks/'.$checkbook->id, $editedcheckbook);

        $this->assertApiResponse($editedcheckbook);
    }

    /**
     * @test
     */
    public function testDeletecheckbook()
    {
        $checkbook = $this->makecheckbook();
        $this->json('DELETE', '/api/v1/checkbooks/'.$checkbook->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/checkbooks/'.$checkbook->id);

        $this->assertResponseStatus(404);
    }
}
