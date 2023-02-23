<?php

use App\Models\checkissuance;
use App\Repositories\checkissuanceRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class checkissuanceRepositoryTest extends TestCase
{
    use MakecheckissuanceTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var checkissuanceRepository
     */
    protected $checkissuanceRepo;

    public function setUp()
    {
        parent::setUp();
        $this->checkissuanceRepo = App::make(checkissuanceRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatecheckissuance()
    {
        $checkissuance = $this->fakecheckissuanceData();
        $createdcheckissuance = $this->checkissuanceRepo->create($checkissuance);
        $createdcheckissuance = $createdcheckissuance->toArray();
        $this->assertArrayHasKey('id', $createdcheckissuance);
        $this->assertNotNull($createdcheckissuance['id'], 'Created checkissuance must have id specified');
        $this->assertNotNull(checkissuance::find($createdcheckissuance['id']), 'checkissuance with given id must be in DB');
        $this->assertModelData($checkissuance, $createdcheckissuance);
    }

    /**
     * @test read
     */
    public function testReadcheckissuance()
    {
        $checkissuance = $this->makecheckissuance();
        $dbcheckissuance = $this->checkissuanceRepo->find($checkissuance->id);
        $dbcheckissuance = $dbcheckissuance->toArray();
        $this->assertModelData($checkissuance->toArray(), $dbcheckissuance);
    }

    /**
     * @test update
     */
    public function testUpdatecheckissuance()
    {
        $checkissuance = $this->makecheckissuance();
        $fakecheckissuance = $this->fakecheckissuanceData();
        $updatedcheckissuance = $this->checkissuanceRepo->update($fakecheckissuance, $checkissuance->id);
        $this->assertModelData($fakecheckissuance, $updatedcheckissuance->toArray());
        $dbcheckissuance = $this->checkissuanceRepo->find($checkissuance->id);
        $this->assertModelData($fakecheckissuance, $dbcheckissuance->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletecheckissuance()
    {
        $checkissuance = $this->makecheckissuance();
        $resp = $this->checkissuanceRepo->delete($checkissuance->id);
        $this->assertTrue($resp);
        $this->assertNull(checkissuance::find($checkissuance->id), 'checkissuance should not exist in DB');
    }
}
