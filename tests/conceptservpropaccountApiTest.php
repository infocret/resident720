<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class conceptservpropaccountApiTest extends TestCase
{
    use MakeconceptservpropaccountTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateconceptservpropaccount()
    {
        $conceptservpropaccount = $this->fakeconceptservpropaccountData();
        $this->json('POST', '/api/v1/conceptservpropaccounts', $conceptservpropaccount);

        $this->assertApiResponse($conceptservpropaccount);
    }

    /**
     * @test
     */
    public function testReadconceptservpropaccount()
    {
        $conceptservpropaccount = $this->makeconceptservpropaccount();
        $this->json('GET', '/api/v1/conceptservpropaccounts/'.$conceptservpropaccount->id);

        $this->assertApiResponse($conceptservpropaccount->toArray());
    }

    /**
     * @test
     */
    public function testUpdateconceptservpropaccount()
    {
        $conceptservpropaccount = $this->makeconceptservpropaccount();
        $editedconceptservpropaccount = $this->fakeconceptservpropaccountData();

        $this->json('PUT', '/api/v1/conceptservpropaccounts/'.$conceptservpropaccount->id, $editedconceptservpropaccount);

        $this->assertApiResponse($editedconceptservpropaccount);
    }

    /**
     * @test
     */
    public function testDeleteconceptservpropaccount()
    {
        $conceptservpropaccount = $this->makeconceptservpropaccount();
        $this->json('DELETE', '/api/v1/conceptservpropaccounts/'.$conceptservpropaccount->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/conceptservpropaccounts/'.$conceptservpropaccount->id);

        $this->assertResponseStatus(404);
    }
}
