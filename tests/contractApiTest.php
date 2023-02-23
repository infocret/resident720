<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class contractApiTest extends TestCase
{
    use MakecontractTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatecontract()
    {
        $contract = $this->fakecontractData();
        $this->json('POST', '/api/v1/contracts', $contract);

        $this->assertApiResponse($contract);
    }

    /**
     * @test
     */
    public function testReadcontract()
    {
        $contract = $this->makecontract();
        $this->json('GET', '/api/v1/contracts/'.$contract->id);

        $this->assertApiResponse($contract->toArray());
    }

    /**
     * @test
     */
    public function testUpdatecontract()
    {
        $contract = $this->makecontract();
        $editedcontract = $this->fakecontractData();

        $this->json('PUT', '/api/v1/contracts/'.$contract->id, $editedcontract);

        $this->assertApiResponse($editedcontract);
    }

    /**
     * @test
     */
    public function testDeletecontract()
    {
        $contract = $this->makecontract();
        $this->json('DELETE', '/api/v1/contracts/'.$contract->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/contracts/'.$contract->id);

        $this->assertResponseStatus(404);
    }
}
