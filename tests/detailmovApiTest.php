<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class detailmovApiTest extends TestCase
{
    use MakedetailmovTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatedetailmov()
    {
        $detailmov = $this->fakedetailmovData();
        $this->json('POST', '/api/v1/detailmovs', $detailmov);

        $this->assertApiResponse($detailmov);
    }

    /**
     * @test
     */
    public function testReaddetailmov()
    {
        $detailmov = $this->makedetailmov();
        $this->json('GET', '/api/v1/detailmovs/'.$detailmov->id);

        $this->assertApiResponse($detailmov->toArray());
    }

    /**
     * @test
     */
    public function testUpdatedetailmov()
    {
        $detailmov = $this->makedetailmov();
        $editeddetailmov = $this->fakedetailmovData();

        $this->json('PUT', '/api/v1/detailmovs/'.$detailmov->id, $editeddetailmov);

        $this->assertApiResponse($editeddetailmov);
    }

    /**
     * @test
     */
    public function testDeletedetailmov()
    {
        $detailmov = $this->makedetailmov();
        $this->json('DELETE', '/api/v1/detailmovs/'.$detailmov->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/detailmovs/'.$detailmov->id);

        $this->assertResponseStatus(404);
    }
}
