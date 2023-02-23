<?php

use App\Models\ticket;
use App\Repositories\ticketRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ticketRepositoryTest extends TestCase
{
    use MaketicketTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ticketRepository
     */
    protected $ticketRepo;

    public function setUp()
    {
        parent::setUp();
        $this->ticketRepo = App::make(ticketRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateticket()
    {
        $ticket = $this->faketicketData();
        $createdticket = $this->ticketRepo->create($ticket);
        $createdticket = $createdticket->toArray();
        $this->assertArrayHasKey('id', $createdticket);
        $this->assertNotNull($createdticket['id'], 'Created ticket must have id specified');
        $this->assertNotNull(ticket::find($createdticket['id']), 'ticket with given id must be in DB');
        $this->assertModelData($ticket, $createdticket);
    }

    /**
     * @test read
     */
    public function testReadticket()
    {
        $ticket = $this->maketicket();
        $dbticket = $this->ticketRepo->find($ticket->id);
        $dbticket = $dbticket->toArray();
        $this->assertModelData($ticket->toArray(), $dbticket);
    }

    /**
     * @test update
     */
    public function testUpdateticket()
    {
        $ticket = $this->maketicket();
        $faketicket = $this->faketicketData();
        $updatedticket = $this->ticketRepo->update($faketicket, $ticket->id);
        $this->assertModelData($faketicket, $updatedticket->toArray());
        $dbticket = $this->ticketRepo->find($ticket->id);
        $this->assertModelData($faketicket, $dbticket->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteticket()
    {
        $ticket = $this->maketicket();
        $resp = $this->ticketRepo->delete($ticket->id);
        $this->assertTrue($resp);
        $this->assertNull(ticket::find($ticket->id), 'ticket should not exist in DB');
    }
}
