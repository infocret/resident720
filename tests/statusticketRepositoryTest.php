<?php

use App\Models\statusticket;
use App\Repositories\statusticketRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class statusticketRepositoryTest extends TestCase
{
    use MakestatusticketTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var statusticketRepository
     */
    protected $statusticketRepo;

    public function setUp()
    {
        parent::setUp();
        $this->statusticketRepo = App::make(statusticketRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatestatusticket()
    {
        $statusticket = $this->fakestatusticketData();
        $createdstatusticket = $this->statusticketRepo->create($statusticket);
        $createdstatusticket = $createdstatusticket->toArray();
        $this->assertArrayHasKey('id', $createdstatusticket);
        $this->assertNotNull($createdstatusticket['id'], 'Created statusticket must have id specified');
        $this->assertNotNull(statusticket::find($createdstatusticket['id']), 'statusticket with given id must be in DB');
        $this->assertModelData($statusticket, $createdstatusticket);
    }

    /**
     * @test read
     */
    public function testReadstatusticket()
    {
        $statusticket = $this->makestatusticket();
        $dbstatusticket = $this->statusticketRepo->find($statusticket->id);
        $dbstatusticket = $dbstatusticket->toArray();
        $this->assertModelData($statusticket->toArray(), $dbstatusticket);
    }

    /**
     * @test update
     */
    public function testUpdatestatusticket()
    {
        $statusticket = $this->makestatusticket();
        $fakestatusticket = $this->fakestatusticketData();
        $updatedstatusticket = $this->statusticketRepo->update($fakestatusticket, $statusticket->id);
        $this->assertModelData($fakestatusticket, $updatedstatusticket->toArray());
        $dbstatusticket = $this->statusticketRepo->find($statusticket->id);
        $this->assertModelData($fakestatusticket, $dbstatusticket->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletestatusticket()
    {
        $statusticket = $this->makestatusticket();
        $resp = $this->statusticketRepo->delete($statusticket->id);
        $this->assertTrue($resp);
        $this->assertNull(statusticket::find($statusticket->id), 'statusticket should not exist in DB');
    }
}
