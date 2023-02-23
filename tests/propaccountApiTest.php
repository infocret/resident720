<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class propaccountApiTest extends TestCase
{
    use MakepropaccountTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatepropaccount()
    {
        $propaccount = $this->fakepropaccountData();
        $this->json('POST', '/api/v1/propaccounts', $propaccount);

        $this->assertApiResponse($propaccount);
    }

    /**
     * @test
     */
    public function testReadpropaccount()
    {
        $propaccount = $this->makepropaccount();
        $this->json('GET', '/api/v1/propaccounts/'.$propaccount->id);

        $this->assertApiResponse($propaccount->toArray());
    }

    /**
     * @test
     */
    public function testUpdatepropaccount()
    {
        $propaccount = $this->makepropaccount();
        $editedpropaccount = $this->fakepropaccountData();

        $this->json('PUT', '/api/v1/propaccounts/'.$propaccount->id, $editedpropaccount);

        $this->assertApiResponse($editedpropaccount);
    }

    /**
     * @test
     */
    public function testDeletepropaccount()
    {
        $propaccount = $this->makepropaccount();
        $this->json('DELETE', '/api/v1/propaccounts/'.$propaccount->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/propaccounts/'.$propaccount->id);

        $this->assertResponseStatus(404);
    }
}
