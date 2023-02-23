<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class movdetailapplieApiTest extends TestCase
{
    use MakemovdetailapplieTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatemovdetailapplie()
    {
        $movdetailapplie = $this->fakemovdetailapplieData();
        $this->json('POST', '/api/v1/movdetailapplies', $movdetailapplie);

        $this->assertApiResponse($movdetailapplie);
    }

    /**
     * @test
     */
    public function testReadmovdetailapplie()
    {
        $movdetailapplie = $this->makemovdetailapplie();
        $this->json('GET', '/api/v1/movdetailapplies/'.$movdetailapplie->id);

        $this->assertApiResponse($movdetailapplie->toArray());
    }

    /**
     * @test
     */
    public function testUpdatemovdetailapplie()
    {
        $movdetailapplie = $this->makemovdetailapplie();
        $editedmovdetailapplie = $this->fakemovdetailapplieData();

        $this->json('PUT', '/api/v1/movdetailapplies/'.$movdetailapplie->id, $editedmovdetailapplie);

        $this->assertApiResponse($editedmovdetailapplie);
    }

    /**
     * @test
     */
    public function testDeletemovdetailapplie()
    {
        $movdetailapplie = $this->makemovdetailapplie();
        $this->json('DELETE', '/api/v1/movdetailapplies/'.$movdetailapplie->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/movdetailapplies/'.$movdetailapplie->id);

        $this->assertResponseStatus(404);
    }
}
