<?php

use App\Models\gasconsumption;
use App\Repositories\gasconsumptionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class gasconsumptionRepositoryTest extends TestCase
{
    use MakegasconsumptionTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var gasconsumptionRepository
     */
    protected $gasconsumptionRepo;

    public function setUp()
    {
        parent::setUp();
        $this->gasconsumptionRepo = App::make(gasconsumptionRepository::class);
    }

    /**
     * @test create
     */
    public function testCreategasconsumption()
    {
        $gasconsumption = $this->fakegasconsumptionData();
        $createdgasconsumption = $this->gasconsumptionRepo->create($gasconsumption);
        $createdgasconsumption = $createdgasconsumption->toArray();
        $this->assertArrayHasKey('id', $createdgasconsumption);
        $this->assertNotNull($createdgasconsumption['id'], 'Created gasconsumption must have id specified');
        $this->assertNotNull(gasconsumption::find($createdgasconsumption['id']), 'gasconsumption with given id must be in DB');
        $this->assertModelData($gasconsumption, $createdgasconsumption);
    }

    /**
     * @test read
     */
    public function testReadgasconsumption()
    {
        $gasconsumption = $this->makegasconsumption();
        $dbgasconsumption = $this->gasconsumptionRepo->find($gasconsumption->id);
        $dbgasconsumption = $dbgasconsumption->toArray();
        $this->assertModelData($gasconsumption->toArray(), $dbgasconsumption);
    }

    /**
     * @test update
     */
    public function testUpdategasconsumption()
    {
        $gasconsumption = $this->makegasconsumption();
        $fakegasconsumption = $this->fakegasconsumptionData();
        $updatedgasconsumption = $this->gasconsumptionRepo->update($fakegasconsumption, $gasconsumption->id);
        $this->assertModelData($fakegasconsumption, $updatedgasconsumption->toArray());
        $dbgasconsumption = $this->gasconsumptionRepo->find($gasconsumption->id);
        $this->assertModelData($fakegasconsumption, $dbgasconsumption->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletegasconsumption()
    {
        $gasconsumption = $this->makegasconsumption();
        $resp = $this->gasconsumptionRepo->delete($gasconsumption->id);
        $this->assertTrue($resp);
        $this->assertNull(gasconsumption::find($gasconsumption->id), 'gasconsumption should not exist in DB');
    }
}
