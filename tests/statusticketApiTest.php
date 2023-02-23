<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class statusticketApiTest extends TestCase
{
    use MakestatusticketTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatestatusticket()
    {
        $statusticket = $this->fakestatusticketData();
        $this->json('POST', '/api/v1/statustickets', $statusticket);

        $this->assertApiResponse($statusticket);
    }

    /**
     * @test
     */
    public function testReadstatusticket()
    {
        $statusticket = $this->makestatusticket();
        $this->json('GET', '/api/v1/statustickets/'.$statusticket->id);

        $this->assertApiResponse($statusticket->toArray());
    }

    /**
     * @test
     */
    public function testUpdatestatusticket()
    {
        $statusticket = $this->makestatusticket();
        $editedstatusticket = $this->fakestatusticketData();

        $this->json('PUT', '/api/v1/statustickets/'.$statusticket->id, $editedstatusticket);

        $this->assertApiResponse($editedstatusticket);
    }

    /**
     * @test
     */
    public function testDeletestatusticket()
    {
        $statusticket = $this->makestatusticket();
        $this->json('DELETE', '/api/v1/statustickets/'.$statusticket->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/statustickets/'.$statusticket->id);

        $this->assertResponseStatus(404);
    }
}
