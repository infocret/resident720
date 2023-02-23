<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class stockApiTest extends TestCase
{
    use MakestockTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatestock()
    {
        $stock = $this->fakestockData();
        $this->json('POST', '/api/v1/stocks', $stock);

        $this->assertApiResponse($stock);
    }

    /**
     * @test
     */
    public function testReadstock()
    {
        $stock = $this->makestock();
        $this->json('GET', '/api/v1/stocks/'.$stock->id);

        $this->assertApiResponse($stock->toArray());
    }

    /**
     * @test
     */
    public function testUpdatestock()
    {
        $stock = $this->makestock();
        $editedstock = $this->fakestockData();

        $this->json('PUT', '/api/v1/stocks/'.$stock->id, $editedstock);

        $this->assertApiResponse($editedstock);
    }

    /**
     * @test
     */
    public function testDeletestock()
    {
        $stock = $this->makestock();
        $this->json('DELETE', '/api/v1/stocks/'.$stock->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/stocks/'.$stock->id);

        $this->assertResponseStatus(404);
    }
}
