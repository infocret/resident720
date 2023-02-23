<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class statusticketimgApiTest extends TestCase
{
    use MakestatusticketimgTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatestatusticketimg()
    {
        $statusticketimg = $this->fakestatusticketimgData();
        $this->json('POST', '/api/v1/statusticketimgs', $statusticketimg);

        $this->assertApiResponse($statusticketimg);
    }

    /**
     * @test
     */
    public function testReadstatusticketimg()
    {
        $statusticketimg = $this->makestatusticketimg();
        $this->json('GET', '/api/v1/statusticketimgs/'.$statusticketimg->id);

        $this->assertApiResponse($statusticketimg->toArray());
    }

    /**
     * @test
     */
    public function testUpdatestatusticketimg()
    {
        $statusticketimg = $this->makestatusticketimg();
        $editedstatusticketimg = $this->fakestatusticketimgData();

        $this->json('PUT', '/api/v1/statusticketimgs/'.$statusticketimg->id, $editedstatusticketimg);

        $this->assertApiResponse($editedstatusticketimg);
    }

    /**
     * @test
     */
    public function testDeletestatusticketimg()
    {
        $statusticketimg = $this->makestatusticketimg();
        $this->json('DELETE', '/api/v1/statusticketimgs/'.$statusticketimg->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/statusticketimgs/'.$statusticketimg->id);

        $this->assertResponseStatus(404);
    }
}
