<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class storageApiTest extends TestCase
{
    use MakestorageTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatestorage()
    {
        $storage = $this->fakestorageData();
        $this->json('POST', '/api/v1/storages', $storage);

        $this->assertApiResponse($storage);
    }

    /**
     * @test
     */
    public function testReadstorage()
    {
        $storage = $this->makestorage();
        $this->json('GET', '/api/v1/storages/'.$storage->id);

        $this->assertApiResponse($storage->toArray());
    }

    /**
     * @test
     */
    public function testUpdatestorage()
    {
        $storage = $this->makestorage();
        $editedstorage = $this->fakestorageData();

        $this->json('PUT', '/api/v1/storages/'.$storage->id, $editedstorage);

        $this->assertApiResponse($editedstorage);
    }

    /**
     * @test
     */
    public function testDeletestorage()
    {
        $storage = $this->makestorage();
        $this->json('DELETE', '/api/v1/storages/'.$storage->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/storages/'.$storage->id);

        $this->assertResponseStatus(404);
    }
}
