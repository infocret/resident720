<?php

use App\Models\contract;
use App\Repositories\contractRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class contractRepositoryTest extends TestCase
{
    use MakecontractTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var contractRepository
     */
    protected $contractRepo;

    public function setUp()
    {
        parent::setUp();
        $this->contractRepo = App::make(contractRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatecontract()
    {
        $contract = $this->fakecontractData();
        $createdcontract = $this->contractRepo->create($contract);
        $createdcontract = $createdcontract->toArray();
        $this->assertArrayHasKey('id', $createdcontract);
        $this->assertNotNull($createdcontract['id'], 'Created contract must have id specified');
        $this->assertNotNull(contract::find($createdcontract['id']), 'contract with given id must be in DB');
        $this->assertModelData($contract, $createdcontract);
    }

    /**
     * @test read
     */
    public function testReadcontract()
    {
        $contract = $this->makecontract();
        $dbcontract = $this->contractRepo->find($contract->id);
        $dbcontract = $dbcontract->toArray();
        $this->assertModelData($contract->toArray(), $dbcontract);
    }

    /**
     * @test update
     */
    public function testUpdatecontract()
    {
        $contract = $this->makecontract();
        $fakecontract = $this->fakecontractData();
        $updatedcontract = $this->contractRepo->update($fakecontract, $contract->id);
        $this->assertModelData($fakecontract, $updatedcontract->toArray());
        $dbcontract = $this->contractRepo->find($contract->id);
        $this->assertModelData($fakecontract, $dbcontract->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletecontract()
    {
        $contract = $this->makecontract();
        $resp = $this->contractRepo->delete($contract->id);
        $this->assertTrue($resp);
        $this->assertNull(contract::find($contract->id), 'contract should not exist in DB');
    }
}
