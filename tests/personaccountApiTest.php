<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class personaccountApiTest extends TestCase
{
    use MakepersonaccountTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatepersonaccount()
    {
        $personaccount = $this->fakepersonaccountData();
        $this->json('POST', '/api/v1/personaccounts', $personaccount);

        $this->assertApiResponse($personaccount);
    }

    /**
     * @test
     */
    public function testReadpersonaccount()
    {
        $personaccount = $this->makepersonaccount();
        $this->json('GET', '/api/v1/personaccounts/'.$personaccount->id);

        $this->assertApiResponse($personaccount->toArray());
    }

    /**
     * @test
     */
    public function testUpdatepersonaccount()
    {
        $personaccount = $this->makepersonaccount();
        $editedpersonaccount = $this->fakepersonaccountData();

        $this->json('PUT', '/api/v1/personaccounts/'.$personaccount->id, $editedpersonaccount);

        $this->assertApiResponse($editedpersonaccount);
    }

    /**
     * @test
     */
    public function testDeletepersonaccount()
    {
        $personaccount = $this->makepersonaccount();
        $this->json('DELETE', '/api/v1/personaccounts/'.$personaccount->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/personaccounts/'.$personaccount->id);

        $this->assertResponseStatus(404);
    }
}
