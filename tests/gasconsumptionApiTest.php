<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class gasconsumptionApiTest extends TestCase
{
    use MakegasconsumptionTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreategasconsumption()
    {
        $gasconsumption = $this->fakegasconsumptionData();
        $this->json('POST', '/api/v1/gasconsumptions', $gasconsumption);

        $this->assertApiResponse($gasconsumption);
    }

    /**
     * @test
     */
    public function testReadgasconsumption()
    {
        $gasconsumption = $this->makegasconsumption();
        $this->json('GET', '/api/v1/gasconsumptions/'.$gasconsumption->id);

        $this->assertApiResponse($gasconsumption->toArray());
    }

    /**
     * @test
     */
    public function testUpdategasconsumption()
    {
        $gasconsumption = $this->makegasconsumption();
        $editedgasconsumption = $this->fakegasconsumptionData();

        $this->json('PUT', '/api/v1/gasconsumptions/'.$gasconsumption->id, $editedgasconsumption);

        $this->assertApiResponse($editedgasconsumption);
    }

    /**
     * @test
     */
    public function testDeletegasconsumption()
    {
        $gasconsumption = $this->makegasconsumption();
        $this->json('DELETE', '/api/v1/gasconsumptions/'.$gasconsumption->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/gasconsumptions/'.$gasconsumption->id);

        $this->assertResponseStatus(404);
    }
}
