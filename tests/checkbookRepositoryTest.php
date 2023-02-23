<?php

use App\Models\checkbook;
use App\Repositories\checkbookRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class checkbookRepositoryTest extends TestCase
{
    use MakecheckbookTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var checkbookRepository
     */
    protected $checkbookRepo;

    public function setUp()
    {
        parent::setUp();
        $this->checkbookRepo = App::make(checkbookRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatecheckbook()
    {
        $checkbook = $this->fakecheckbookData();
        $createdcheckbook = $this->checkbookRepo->create($checkbook);
        $createdcheckbook = $createdcheckbook->toArray();
        $this->assertArrayHasKey('id', $createdcheckbook);
        $this->assertNotNull($createdcheckbook['id'], 'Created checkbook must have id specified');
        $this->assertNotNull(checkbook::find($createdcheckbook['id']), 'checkbook with given id must be in DB');
        $this->assertModelData($checkbook, $createdcheckbook);
    }

    /**
     * @test read
     */
    public function testReadcheckbook()
    {
        $checkbook = $this->makecheckbook();
        $dbcheckbook = $this->checkbookRepo->find($checkbook->id);
        $dbcheckbook = $dbcheckbook->toArray();
        $this->assertModelData($checkbook->toArray(), $dbcheckbook);
    }

    /**
     * @test update
     */
    public function testUpdatecheckbook()
    {
        $checkbook = $this->makecheckbook();
        $fakecheckbook = $this->fakecheckbookData();
        $updatedcheckbook = $this->checkbookRepo->update($fakecheckbook, $checkbook->id);
        $this->assertModelData($fakecheckbook, $updatedcheckbook->toArray());
        $dbcheckbook = $this->checkbookRepo->find($checkbook->id);
        $this->assertModelData($fakecheckbook, $dbcheckbook->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletecheckbook()
    {
        $checkbook = $this->makecheckbook();
        $resp = $this->checkbookRepo->delete($checkbook->id);
        $this->assertTrue($resp);
        $this->assertNull(checkbook::find($checkbook->id), 'checkbook should not exist in DB');
    }
}
