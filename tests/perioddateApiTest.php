<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class perioddateApiTest extends TestCase
{
    use MakeperioddateTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateperioddate()
    {
        $perioddate = $this->fakeperioddateData();
        $this->json('POST', '/api/v1/perioddates', $perioddate);

        $this->assertApiResponse($perioddate);
    }

    /**
     * @test
     */
    public function testReadperioddate()
    {
        $perioddate = $this->makeperioddate();
        $this->json('GET', '/api/v1/perioddates/'.$perioddate->id);

        $this->assertApiResponse($perioddate->toArray());
    }

    /**
     * @test
     */
    public function testUpdateperioddate()
    {
        $perioddate = $this->makeperioddate();
        $editedperioddate = $this->fakeperioddateData();

        $this->json('PUT', '/api/v1/perioddates/'.$perioddate->id, $editedperioddate);

        $this->assertApiResponse($editedperioddate);
    }

    /**
     * @test
     */
    public function testDeleteperioddate()
    {
        $perioddate = $this->makeperioddate();
        $this->json('DELETE', '/api/v1/perioddates/'.$perioddate->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/perioddates/'.$perioddate->id);

        $this->assertResponseStatus(404);
    }
}
