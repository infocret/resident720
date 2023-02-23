<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class movtobankaccountApiTest extends TestCase
{
    use MakemovtobankaccountTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatemovtobankaccount()
    {
        $movtobankaccount = $this->fakemovtobankaccountData();
        $this->json('POST', '/api/v1/movtobankaccounts', $movtobankaccount);

        $this->assertApiResponse($movtobankaccount);
    }

    /**
     * @test
     */
    public function testReadmovtobankaccount()
    {
        $movtobankaccount = $this->makemovtobankaccount();
        $this->json('GET', '/api/v1/movtobankaccounts/'.$movtobankaccount->id);

        $this->assertApiResponse($movtobankaccount->toArray());
    }

    /**
     * @test
     */
    public function testUpdatemovtobankaccount()
    {
        $movtobankaccount = $this->makemovtobankaccount();
        $editedmovtobankaccount = $this->fakemovtobankaccountData();

        $this->json('PUT', '/api/v1/movtobankaccounts/'.$movtobankaccount->id, $editedmovtobankaccount);

        $this->assertApiResponse($editedmovtobankaccount);
    }

    /**
     * @test
     */
    public function testDeletemovtobankaccount()
    {
        $movtobankaccount = $this->makemovtobankaccount();
        $this->json('DELETE', '/api/v1/movtobankaccounts/'.$movtobankaccount->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/movtobankaccounts/'.$movtobankaccount->id);

        $this->assertResponseStatus(404);
    }
}
