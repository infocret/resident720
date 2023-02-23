<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class inmumovtoApiTest extends TestCase
{
    use MakeinmumovtoTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateinmumovto()
    {
        $inmumovto = $this->fakeinmumovtoData();
        $this->json('POST', '/api/v1/inmumovtos', $inmumovto);

        $this->assertApiResponse($inmumovto);
    }

    /**
     * @test
     */
    public function testReadinmumovto()
    {
        $inmumovto = $this->makeinmumovto();
        $this->json('GET', '/api/v1/inmumovtos/'.$inmumovto->id);

        $this->assertApiResponse($inmumovto->toArray());
    }

    /**
     * @test
     */
    public function testUpdateinmumovto()
    {
        $inmumovto = $this->makeinmumovto();
        $editedinmumovto = $this->fakeinmumovtoData();

        $this->json('PUT', '/api/v1/inmumovtos/'.$inmumovto->id, $editedinmumovto);

        $this->assertApiResponse($editedinmumovto);
    }

    /**
     * @test
     */
    public function testDeleteinmumovto()
    {
        $inmumovto = $this->makeinmumovto();
        $this->json('DELETE', '/api/v1/inmumovtos/'.$inmumovto->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/inmumovtos/'.$inmumovto->id);

        $this->assertResponseStatus(404);
    }
}
