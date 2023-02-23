<?php

use App\Models\checkbooktracking;
use App\Repositories\checkbooktrackingRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class checkbooktrackingRepositoryTest extends TestCase
{
    use MakecheckbooktrackingTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var checkbooktrackingRepository
     */
    protected $checkbooktrackingRepo;

    public function setUp()
    {
        parent::setUp();
        $this->checkbooktrackingRepo = App::make(checkbooktrackingRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatecheckbooktracking()
    {
        $checkbooktracking = $this->fakecheckbooktrackingData();
        $createdcheckbooktracking = $this->checkbooktrackingRepo->create($checkbooktracking);
        $createdcheckbooktracking = $createdcheckbooktracking->toArray();
        $this->assertArrayHasKey('id', $createdcheckbooktracking);
        $this->assertNotNull($createdcheckbooktracking['id'], 'Created checkbooktracking must have id specified');
        $this->assertNotNull(checkbooktracking::find($createdcheckbooktracking['id']), 'checkbooktracking with given id must be in DB');
        $this->assertModelData($checkbooktracking, $createdcheckbooktracking);
    }

    /**
     * @test read
     */
    public function testReadcheckbooktracking()
    {
        $checkbooktracking = $this->makecheckbooktracking();
        $dbcheckbooktracking = $this->checkbooktrackingRepo->find($checkbooktracking->id);
        $dbcheckbooktracking = $dbcheckbooktracking->toArray();
        $this->assertModelData($checkbooktracking->toArray(), $dbcheckbooktracking);
    }

    /**
     * @test update
     */
    public function testUpdatecheckbooktracking()
    {
        $checkbooktracking = $this->makecheckbooktracking();
        $fakecheckbooktracking = $this->fakecheckbooktrackingData();
        $updatedcheckbooktracking = $this->checkbooktrackingRepo->update($fakecheckbooktracking, $checkbooktracking->id);
        $this->assertModelData($fakecheckbooktracking, $updatedcheckbooktracking->toArray());
        $dbcheckbooktracking = $this->checkbooktrackingRepo->find($checkbooktracking->id);
        $this->assertModelData($fakecheckbooktracking, $dbcheckbooktracking->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletecheckbooktracking()
    {
        $checkbooktracking = $this->makecheckbooktracking();
        $resp = $this->checkbooktrackingRepo->delete($checkbooktracking->id);
        $this->assertTrue($resp);
        $this->assertNull(checkbooktracking::find($checkbooktracking->id), 'checkbooktracking should not exist in DB');
    }
}
