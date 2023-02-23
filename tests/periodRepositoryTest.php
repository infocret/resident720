<?php

use App\Models\period;
use App\Repositories\periodRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class periodRepositoryTest extends TestCase
{
    use MakeperiodTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var periodRepository
     */
    protected $periodRepo;

    public function setUp()
    {
        parent::setUp();
        $this->periodRepo = App::make(periodRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateperiod()
    {
        $period = $this->fakeperiodData();
        $createdperiod = $this->periodRepo->create($period);
        $createdperiod = $createdperiod->toArray();
        $this->assertArrayHasKey('id', $createdperiod);
        $this->assertNotNull($createdperiod['id'], 'Created period must have id specified');
        $this->assertNotNull(period::find($createdperiod['id']), 'period with given id must be in DB');
        $this->assertModelData($period, $createdperiod);
    }

    /**
     * @test read
     */
    public function testReadperiod()
    {
        $period = $this->makeperiod();
        $dbperiod = $this->periodRepo->find($period->id);
        $dbperiod = $dbperiod->toArray();
        $this->assertModelData($period->toArray(), $dbperiod);
    }

    /**
     * @test update
     */
    public function testUpdateperiod()
    {
        $period = $this->makeperiod();
        $fakeperiod = $this->fakeperiodData();
        $updatedperiod = $this->periodRepo->update($fakeperiod, $period->id);
        $this->assertModelData($fakeperiod, $updatedperiod->toArray());
        $dbperiod = $this->periodRepo->find($period->id);
        $this->assertModelData($fakeperiod, $dbperiod->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteperiod()
    {
        $period = $this->makeperiod();
        $resp = $this->periodRepo->delete($period->id);
        $this->assertTrue($resp);
        $this->assertNull(period::find($period->id), 'period should not exist in DB');
    }
}
