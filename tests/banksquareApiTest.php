<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class banksquareApiTest extends TestCase
{
    use MakebanksquareTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatebanksquare()
    {
        $banksquare = $this->fakebanksquareData();
        $this->json('POST', '/api/v1/banksquares', $banksquare);

        $this->assertApiResponse($banksquare);
    }

    /**
     * @test
     */
    public function testReadbanksquare()
    {
        $banksquare = $this->makebanksquare();
        $this->json('GET', '/api/v1/banksquares/'.$banksquare->id);

        $this->assertApiResponse($banksquare->toArray());
    }

    /**
     * @test
     */
    public function testUpdatebanksquare()
    {
        $banksquare = $this->makebanksquare();
        $editedbanksquare = $this->fakebanksquareData();

        $this->json('PUT', '/api/v1/banksquares/'.$banksquare->id, $editedbanksquare);

        $this->assertApiResponse($editedbanksquare);
    }

    /**
     * @test
     */
    public function testDeletebanksquare()
    {
        $banksquare = $this->makebanksquare();
        $this->json('DELETE', '/api/v1/banksquares/'.$banksquare->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/banksquares/'.$banksquare->id);

        $this->assertResponseStatus(404);
    }
}
