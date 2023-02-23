<?php

use App\Models\stockmovement;
use App\Repositories\stockmovementRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class stockmovementRepositoryTest extends TestCase
{
    use MakestockmovementTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var stockmovementRepository
     */
    protected $stockmovementRepo;

    public function setUp()
    {
        parent::setUp();
        $this->stockmovementRepo = App::make(stockmovementRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatestockmovement()
    {
        $stockmovement = $this->fakestockmovementData();
        $createdstockmovement = $this->stockmovementRepo->create($stockmovement);
        $createdstockmovement = $createdstockmovement->toArray();
        $this->assertArrayHasKey('id', $createdstockmovement);
        $this->assertNotNull($createdstockmovement['id'], 'Created stockmovement must have id specified');
        $this->assertNotNull(stockmovement::find($createdstockmovement['id']), 'stockmovement with given id must be in DB');
        $this->assertModelData($stockmovement, $createdstockmovement);
    }

    /**
     * @test read
     */
    public function testReadstockmovement()
    {
        $stockmovement = $this->makestockmovement();
        $dbstockmovement = $this->stockmovementRepo->find($stockmovement->id);
        $dbstockmovement = $dbstockmovement->toArray();
        $this->assertModelData($stockmovement->toArray(), $dbstockmovement);
    }

    /**
     * @test update
     */
    public function testUpdatestockmovement()
    {
        $stockmovement = $this->makestockmovement();
        $fakestockmovement = $this->fakestockmovementData();
        $updatedstockmovement = $this->stockmovementRepo->update($fakestockmovement, $stockmovement->id);
        $this->assertModelData($fakestockmovement, $updatedstockmovement->toArray());
        $dbstockmovement = $this->stockmovementRepo->find($stockmovement->id);
        $this->assertModelData($fakestockmovement, $dbstockmovement->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletestockmovement()
    {
        $stockmovement = $this->makestockmovement();
        $resp = $this->stockmovementRepo->delete($stockmovement->id);
        $this->assertTrue($resp);
        $this->assertNull(stockmovement::find($stockmovement->id), 'stockmovement should not exist in DB');
    }
}
