<?php

use App\Models\checkbookprint;
use App\Repositories\checkbookprintRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class checkbookprintRepositoryTest extends TestCase
{
    use MakecheckbookprintTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var checkbookprintRepository
     */
    protected $checkbookprintRepo;

    public function setUp()
    {
        parent::setUp();
        $this->checkbookprintRepo = App::make(checkbookprintRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatecheckbookprint()
    {
        $checkbookprint = $this->fakecheckbookprintData();
        $createdcheckbookprint = $this->checkbookprintRepo->create($checkbookprint);
        $createdcheckbookprint = $createdcheckbookprint->toArray();
        $this->assertArrayHasKey('id', $createdcheckbookprint);
        $this->assertNotNull($createdcheckbookprint['id'], 'Created checkbookprint must have id specified');
        $this->assertNotNull(checkbookprint::find($createdcheckbookprint['id']), 'checkbookprint with given id must be in DB');
        $this->assertModelData($checkbookprint, $createdcheckbookprint);
    }

    /**
     * @test read
     */
    public function testReadcheckbookprint()
    {
        $checkbookprint = $this->makecheckbookprint();
        $dbcheckbookprint = $this->checkbookprintRepo->find($checkbookprint->id);
        $dbcheckbookprint = $dbcheckbookprint->toArray();
        $this->assertModelData($checkbookprint->toArray(), $dbcheckbookprint);
    }

    /**
     * @test update
     */
    public function testUpdatecheckbookprint()
    {
        $checkbookprint = $this->makecheckbookprint();
        $fakecheckbookprint = $this->fakecheckbookprintData();
        $updatedcheckbookprint = $this->checkbookprintRepo->update($fakecheckbookprint, $checkbookprint->id);
        $this->assertModelData($fakecheckbookprint, $updatedcheckbookprint->toArray());
        $dbcheckbookprint = $this->checkbookprintRepo->find($checkbookprint->id);
        $this->assertModelData($fakecheckbookprint, $dbcheckbookprint->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletecheckbookprint()
    {
        $checkbookprint = $this->makecheckbookprint();
        $resp = $this->checkbookprintRepo->delete($checkbookprint->id);
        $this->assertTrue($resp);
        $this->assertNull(checkbookprint::find($checkbookprint->id), 'checkbookprint should not exist in DB');
    }
}
