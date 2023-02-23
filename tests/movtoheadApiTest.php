<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class movtoheadApiTest extends TestCase
{
    use MakemovtoheadTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatemovtohead()
    {
        $movtohead = $this->fakemovtoheadData();
        $this->json('POST', '/api/v1/movtoheads', $movtohead);

        $this->assertApiResponse($movtohead);
    }

    /**
     * @test
     */
    public function testReadmovtohead()
    {
        $movtohead = $this->makemovtohead();
        $this->json('GET', '/api/v1/movtoheads/'.$movtohead->id);

        $this->assertApiResponse($movtohead->toArray());
    }

    /**
     * @test
     */
    public function testUpdatemovtohead()
    {
        $movtohead = $this->makemovtohead();
        $editedmovtohead = $this->fakemovtoheadData();

        $this->json('PUT', '/api/v1/movtoheads/'.$movtohead->id, $editedmovtohead);

        $this->assertApiResponse($editedmovtohead);
    }

    /**
     * @test
     */
    public function testDeletemovtohead()
    {
        $movtohead = $this->makemovtohead();
        $this->json('DELETE', '/api/v1/movtoheads/'.$movtohead->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/movtoheads/'.$movtohead->id);

        $this->assertResponseStatus(404);
    }
}
