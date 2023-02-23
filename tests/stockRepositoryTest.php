<?php

use App\Models\stock;
use App\Repositories\stockRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class stockRepositoryTest extends TestCase
{
    use MakestockTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var stockRepository
     */
    protected $stockRepo;

    public function setUp()
    {
        parent::setUp();
        $this->stockRepo = App::make(stockRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatestock()
    {
        $stock = $this->fakestockData();
        $createdstock = $this->stockRepo->create($stock);
        $createdstock = $createdstock->toArray();
        $this->assertArrayHasKey('id', $createdstock);
        $this->assertNotNull($createdstock['id'], 'Created stock must have id specified');
        $this->assertNotNull(stock::find($createdstock['id']), 'stock with given id must be in DB');
        $this->assertModelData($stock, $createdstock);
    }

    /**
     * @test read
     */
    public function testReadstock()
    {
        $stock = $this->makestock();
        $dbstock = $this->stockRepo->find($stock->id);
        $dbstock = $dbstock->toArray();
        $this->assertModelData($stock->toArray(), $dbstock);
    }

    /**
     * @test update
     */
    public function testUpdatestock()
    {
        $stock = $this->makestock();
        $fakestock = $this->fakestockData();
        $updatedstock = $this->stockRepo->update($fakestock, $stock->id);
        $this->assertModelData($fakestock, $updatedstock->toArray());
        $dbstock = $this->stockRepo->find($stock->id);
        $this->assertModelData($fakestock, $dbstock->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletestock()
    {
        $stock = $this->makestock();
        $resp = $this->stockRepo->delete($stock->id);
        $this->assertTrue($resp);
        $this->assertNull(stock::find($stock->id), 'stock should not exist in DB');
    }
}
