<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ticketApiTest extends TestCase
{
    use MaketicketTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateticket()
    {
        $ticket = $this->faketicketData();
        $this->json('POST', '/api/v1/tickets', $ticket);

        $this->assertApiResponse($ticket);
    }

    /**
     * @test
     */
    public function testReadticket()
    {
        $ticket = $this->maketicket();
        $this->json('GET', '/api/v1/tickets/'.$ticket->id);

        $this->assertApiResponse($ticket->toArray());
    }

    /**
     * @test
     */
    public function testUpdateticket()
    {
        $ticket = $this->maketicket();
        $editedticket = $this->faketicketData();

        $this->json('PUT', '/api/v1/tickets/'.$ticket->id, $editedticket);

        $this->assertApiResponse($editedticket);
    }

    /**
     * @test
     */
    public function testDeleteticket()
    {
        $ticket = $this->maketicket();
        $this->json('DELETE', '/api/v1/tickets/'.$ticket->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/tickets/'.$ticket->id);

        $this->assertResponseStatus(404);
    }
}
