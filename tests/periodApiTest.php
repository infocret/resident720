<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class periodApiTest extends TestCase
{
    use MakeperiodTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateperiod()
    {
        $period = $this->fakeperiodData();
        $this->json('POST', '/api/v1/periods', $period);

        $this->assertApiResponse($period);
    }

    /**
     * @test
     */
    public function testReadperiod()
    {
        $period = $this->makeperiod();
        $this->json('GET', '/api/v1/periods/'.$period->id);

        $this->assertApiResponse($period->toArray());
    }

    /**
     * @test
     */
    public function testUpdateperiod()
    {
        $period = $this->makeperiod();
        $editedperiod = $this->fakeperiodData();

        $this->json('PUT', '/api/v1/periods/'.$period->id, $editedperiod);

        $this->assertApiResponse($editedperiod);
    }

    /**
     * @test
     */
    public function testDeleteperiod()
    {
        $period = $this->makeperiod();
        $this->json('DELETE', '/api/v1/periods/'.$period->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/periods/'.$period->id);

        $this->assertResponseStatus(404);
    }
}
