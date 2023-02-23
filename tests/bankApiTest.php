<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class bankApiTest extends TestCase
{
    use MakebankTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatebank()
    {
        $bank = $this->fakebankData();
        $this->json('POST', '/api/v1/banks', $bank);

        $this->assertApiResponse($bank);
    }

    /**
     * @test
     */
    public function testReadbank()
    {
        $bank = $this->makebank();
        $this->json('GET', '/api/v1/banks/'.$bank->id);

        $this->assertApiResponse($bank->toArray());
    }

    /**
     * @test
     */
    public function testUpdatebank()
    {
        $bank = $this->makebank();
        $editedbank = $this->fakebankData();

        $this->json('PUT', '/api/v1/banks/'.$bank->id, $editedbank);

        $this->assertApiResponse($editedbank);
    }

    /**
     * @test
     */
    public function testDeletebank()
    {
        $bank = $this->makebank();
        $this->json('DELETE', '/api/v1/banks/'.$bank->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/banks/'.$bank->id);

        $this->assertResponseStatus(404);
    }
}
