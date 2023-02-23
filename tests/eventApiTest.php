<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class eventApiTest extends TestCase
{
    use MakeeventTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateevent()
    {
        $event = $this->fakeeventData();
        $this->json('POST', '/api/v1/events', $event);

        $this->assertApiResponse($event);
    }

    /**
     * @test
     */
    public function testReadevent()
    {
        $event = $this->makeevent();
        $this->json('GET', '/api/v1/events/'.$event->id);

        $this->assertApiResponse($event->toArray());
    }

    /**
     * @test
     */
    public function testUpdateevent()
    {
        $event = $this->makeevent();
        $editedevent = $this->fakeeventData();

        $this->json('PUT', '/api/v1/events/'.$event->id, $editedevent);

        $this->assertApiResponse($editedevent);
    }

    /**
     * @test
     */
    public function testDeleteevent()
    {
        $event = $this->makeevent();
        $this->json('DELETE', '/api/v1/events/'.$event->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/events/'.$event->id);

        $this->assertResponseStatus(404);
    }
}
