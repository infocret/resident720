<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class bankaccountApiTest extends TestCase
{
    use MakebankaccountTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatebankaccount()
    {
        $bankaccount = $this->fakebankaccountData();
        $this->json('POST', '/api/v1/bankaccounts', $bankaccount);

        $this->assertApiResponse($bankaccount);
    }

    /**
     * @test
     */
    public function testReadbankaccount()
    {
        $bankaccount = $this->makebankaccount();
        $this->json('GET', '/api/v1/bankaccounts/'.$bankaccount->id);

        $this->assertApiResponse($bankaccount->toArray());
    }

    /**
     * @test
     */
    public function testUpdatebankaccount()
    {
        $bankaccount = $this->makebankaccount();
        $editedbankaccount = $this->fakebankaccountData();

        $this->json('PUT', '/api/v1/bankaccounts/'.$bankaccount->id, $editedbankaccount);

        $this->assertApiResponse($editedbankaccount);
    }

    /**
     * @test
     */
    public function testDeletebankaccount()
    {
        $bankaccount = $this->makebankaccount();
        $this->json('DELETE', '/api/v1/bankaccounts/'.$bankaccount->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/bankaccounts/'.$bankaccount->id);

        $this->assertResponseStatus(404);
    }
}
