<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class headmovApiTest extends TestCase
{
    use MakeheadmovTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateheadmov()
    {
        $headmov = $this->fakeheadmovData();
        $this->json('POST', '/api/v1/headmovs', $headmov);

        $this->assertApiResponse($headmov);
    }

    /**
     * @test
     */
    public function testReadheadmov()
    {
        $headmov = $this->makeheadmov();
        $this->json('GET', '/api/v1/headmovs/'.$headmov->id);

        $this->assertApiResponse($headmov->toArray());
    }

    /**
     * @test
     */
    public function testUpdateheadmov()
    {
        $headmov = $this->makeheadmov();
        $editedheadmov = $this->fakeheadmovData();

        $this->json('PUT', '/api/v1/headmovs/'.$headmov->id, $editedheadmov);

        $this->assertApiResponse($editedheadmov);
    }

    /**
     * @test
     */
    public function testDeleteheadmov()
    {
        $headmov = $this->makeheadmov();
        $this->json('DELETE', '/api/v1/headmovs/'.$headmov->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/headmovs/'.$headmov->id);

        $this->assertResponseStatus(404);
    }
}
