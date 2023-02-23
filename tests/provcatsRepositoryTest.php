<?php

use App\Models\provcats;
use App\Repositories\provcatsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class provcatsRepositoryTest extends TestCase
{
    use MakeprovcatsTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var provcatsRepository
     */
    protected $provcatsRepo;

    public function setUp()
    {
        parent::setUp();
        $this->provcatsRepo = App::make(provcatsRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateprovcats()
    {
        $provcats = $this->fakeprovcatsData();
        $createdprovcats = $this->provcatsRepo->create($provcats);
        $createdprovcats = $createdprovcats->toArray();
        $this->assertArrayHasKey('id', $createdprovcats);
        $this->assertNotNull($createdprovcats['id'], 'Created provcats must have id specified');
        $this->assertNotNull(provcats::find($createdprovcats['id']), 'provcats with given id must be in DB');
        $this->assertModelData($provcats, $createdprovcats);
    }

    /**
     * @test read
     */
    public function testReadprovcats()
    {
        $provcats = $this->makeprovcats();
        $dbprovcats = $this->provcatsRepo->find($provcats->id);
        $dbprovcats = $dbprovcats->toArray();
        $this->assertModelData($provcats->toArray(), $dbprovcats);
    }

    /**
     * @test update
     */
    public function testUpdateprovcats()
    {
        $provcats = $this->makeprovcats();
        $fakeprovcats = $this->fakeprovcatsData();
        $updatedprovcats = $this->provcatsRepo->update($fakeprovcats, $provcats->id);
        $this->assertModelData($fakeprovcats, $updatedprovcats->toArray());
        $dbprovcats = $this->provcatsRepo->find($provcats->id);
        $this->assertModelData($fakeprovcats, $dbprovcats->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteprovcats()
    {
        $provcats = $this->makeprovcats();
        $resp = $this->provcatsRepo->delete($provcats->id);
        $this->assertTrue($resp);
        $this->assertNull(provcats::find($provcats->id), 'provcats should not exist in DB');
    }
}
