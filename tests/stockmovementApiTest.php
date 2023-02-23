<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class stockmovementApiTest extends TestCase
{
    use MakestockmovementTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatestockmovement()
    {
        $stockmovement = $this->fakestockmovementData();
        $this->json('POST', '/api/v1/stockmovements', $stockmovement);

        $this->assertApiResponse($stockmovement);
    }

    /**
     * @test
     */
    public function testReadstockmovement()
    {
        $stockmovement = $this->makestockmovement();
        $this->json('GET', '/api/v1/stockmovements/'.$stockmovement->id);

        $this->assertApiResponse($stockmovement->toArray());
    }

    /**
     * @test
     */
    public function testUpdatestockmovement()
    {
        $stockmovement = $this->makestockmovement();
        $editedstockmovement = $this->fakestockmovementData();

        $this->json('PUT', '/api/v1/stockmovements/'.$stockmovement->id, $editedstockmovement);

        $this->assertApiResponse($editedstockmovement);
    }

    /**
     * @test
     */
    public function testDeletestockmovement()
    {
        $stockmovement = $this->makestockmovement();
        $this->json('DELETE', '/api/v1/stockmovements/'.$stockmovement->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/stockmovements/'.$stockmovement->id);

        $this->assertResponseStatus(404);
    }
}
