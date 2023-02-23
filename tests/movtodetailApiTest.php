<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class movtodetailApiTest extends TestCase
{
    use MakemovtodetailTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatemovtodetail()
    {
        $movtodetail = $this->fakemovtodetailData();
        $this->json('POST', '/api/v1/movtodetails', $movtodetail);

        $this->assertApiResponse($movtodetail);
    }

    /**
     * @test
     */
    public function testReadmovtodetail()
    {
        $movtodetail = $this->makemovtodetail();
        $this->json('GET', '/api/v1/movtodetails/'.$movtodetail->id);

        $this->assertApiResponse($movtodetail->toArray());
    }

    /**
     * @test
     */
    public function testUpdatemovtodetail()
    {
        $movtodetail = $this->makemovtodetail();
        $editedmovtodetail = $this->fakemovtodetailData();

        $this->json('PUT', '/api/v1/movtodetails/'.$movtodetail->id, $editedmovtodetail);

        $this->assertApiResponse($editedmovtodetail);
    }

    /**
     * @test
     */
    public function testDeletemovtodetail()
    {
        $movtodetail = $this->makemovtodetail();
        $this->json('DELETE', '/api/v1/movtodetails/'.$movtodetail->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/movtodetails/'.$movtodetail->id);

        $this->assertResponseStatus(404);
    }
}
