<?php

use App\Models\event;
use App\Repositories\eventRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class eventRepositoryTest extends TestCase
{
    use MakeeventTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var eventRepository
     */
    protected $eventRepo;

    public function setUp()
    {
        parent::setUp();
        $this->eventRepo = App::make(eventRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateevent()
    {
        $event = $this->fakeeventData();
        $createdevent = $this->eventRepo->create($event);
        $createdevent = $createdevent->toArray();
        $this->assertArrayHasKey('id', $createdevent);
        $this->assertNotNull($createdevent['id'], 'Created event must have id specified');
        $this->assertNotNull(event::find($createdevent['id']), 'event with given id must be in DB');
        $this->assertModelData($event, $createdevent);
    }

    /**
     * @test read
     */
    public function testReadevent()
    {
        $event = $this->makeevent();
        $dbevent = $this->eventRepo->find($event->id);
        $dbevent = $dbevent->toArray();
        $this->assertModelData($event->toArray(), $dbevent);
    }

    /**
     * @test update
     */
    public function testUpdateevent()
    {
        $event = $this->makeevent();
        $fakeevent = $this->fakeeventData();
        $updatedevent = $this->eventRepo->update($fakeevent, $event->id);
        $this->assertModelData($fakeevent, $updatedevent->toArray());
        $dbevent = $this->eventRepo->find($event->id);
        $this->assertModelData($fakeevent, $dbevent->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteevent()
    {
        $event = $this->makeevent();
        $resp = $this->eventRepo->delete($event->id);
        $this->assertTrue($resp);
        $this->assertNull(event::find($event->id), 'event should not exist in DB');
    }
}
