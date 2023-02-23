<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class InmuebleImagesidsApiTest extends TestCase
{
    use MakeInmuebleImagesidsTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateInmuebleImagesids()
    {
        $inmuebleImagesids = $this->fakeInmuebleImagesidsData();
        $this->json('POST', '/api/v1/inmuebleImagesids', $inmuebleImagesids);

        $this->assertApiResponse($inmuebleImagesids);
    }

    /**
     * @test
     */
    public function testReadInmuebleImagesids()
    {
        $inmuebleImagesids = $this->makeInmuebleImagesids();
        $this->json('GET', '/api/v1/inmuebleImagesids/'.$inmuebleImagesids->id);

        $this->assertApiResponse($inmuebleImagesids->toArray());
    }

    /**
     * @test
     */
    public function testUpdateInmuebleImagesids()
    {
        $inmuebleImagesids = $this->makeInmuebleImagesids();
        $editedInmuebleImagesids = $this->fakeInmuebleImagesidsData();

        $this->json('PUT', '/api/v1/inmuebleImagesids/'.$inmuebleImagesids->id, $editedInmuebleImagesids);

        $this->assertApiResponse($editedInmuebleImagesids);
    }

    /**
     * @test
     */
    public function testDeleteInmuebleImagesids()
    {
        $inmuebleImagesids = $this->makeInmuebleImagesids();
        $this->json('DELETE', '/api/v1/inmuebleImagesids/'.$inmuebleImagesids->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/inmuebleImagesids/'.$inmuebleImagesids->id);

        $this->assertResponseStatus(404);
    }
}
