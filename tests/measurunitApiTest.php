<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class measurunitApiTest extends TestCase
{
    use MakemeasurunitTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatemeasurunit()
    {
        $measurunit = $this->fakemeasurunitData();
        $this->json('POST', '/api/v1/measurunits', $measurunit);

        $this->assertApiResponse($measurunit);
    }

    /**
     * @test
     */
    public function testReadmeasurunit()
    {
        $measurunit = $this->makemeasurunit();
        $this->json('GET', '/api/v1/measurunits/'.$measurunit->id);

        $this->assertApiResponse($measurunit->toArray());
    }

    /**
     * @test
     */
    public function testUpdatemeasurunit()
    {
        $measurunit = $this->makemeasurunit();
        $editedmeasurunit = $this->fakemeasurunitData();

        $this->json('PUT', '/api/v1/measurunits/'.$measurunit->id, $editedmeasurunit);

        $this->assertApiResponse($editedmeasurunit);
    }

    /**
     * @test
     */
    public function testDeletemeasurunit()
    {
        $measurunit = $this->makemeasurunit();
        $this->json('DELETE', '/api/v1/measurunits/'.$measurunit->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/measurunits/'.$measurunit->id);

        $this->assertResponseStatus(404);
    }
}
