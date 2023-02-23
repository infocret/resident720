<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class provideraccountApiTest extends TestCase
{
    use MakeprovideraccountTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateprovideraccount()
    {
        $provideraccount = $this->fakeprovideraccountData();
        $this->json('POST', '/api/v1/provideraccounts', $provideraccount);

        $this->assertApiResponse($provideraccount);
    }

    /**
     * @test
     */
    public function testReadprovideraccount()
    {
        $provideraccount = $this->makeprovideraccount();
        $this->json('GET', '/api/v1/provideraccounts/'.$provideraccount->id);

        $this->assertApiResponse($provideraccount->toArray());
    }

    /**
     * @test
     */
    public function testUpdateprovideraccount()
    {
        $provideraccount = $this->makeprovideraccount();
        $editedprovideraccount = $this->fakeprovideraccountData();

        $this->json('PUT', '/api/v1/provideraccounts/'.$provideraccount->id, $editedprovideraccount);

        $this->assertApiResponse($editedprovideraccount);
    }

    /**
     * @test
     */
    public function testDeleteprovideraccount()
    {
        $provideraccount = $this->makeprovideraccount();
        $this->json('DELETE', '/api/v1/provideraccounts/'.$provideraccount->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/provideraccounts/'.$provideraccount->id);

        $this->assertResponseStatus(404);
    }
}
