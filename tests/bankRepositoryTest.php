<?php

use App\Models\bank;
use App\Repositories\bankRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class bankRepositoryTest extends TestCase
{
    use MakebankTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var bankRepository
     */
    protected $bankRepo;

    public function setUp()
    {
        parent::setUp();
        $this->bankRepo = App::make(bankRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatebank()
    {
        $bank = $this->fakebankData();
        $createdbank = $this->bankRepo->create($bank);
        $createdbank = $createdbank->toArray();
        $this->assertArrayHasKey('id', $createdbank);
        $this->assertNotNull($createdbank['id'], 'Created bank must have id specified');
        $this->assertNotNull(bank::find($createdbank['id']), 'bank with given id must be in DB');
        $this->assertModelData($bank, $createdbank);
    }

    /**
     * @test read
     */
    public function testReadbank()
    {
        $bank = $this->makebank();
        $dbbank = $this->bankRepo->find($bank->id);
        $dbbank = $dbbank->toArray();
        $this->assertModelData($bank->toArray(), $dbbank);
    }

    /**
     * @test update
     */
    public function testUpdatebank()
    {
        $bank = $this->makebank();
        $fakebank = $this->fakebankData();
        $updatedbank = $this->bankRepo->update($fakebank, $bank->id);
        $this->assertModelData($fakebank, $updatedbank->toArray());
        $dbbank = $this->bankRepo->find($bank->id);
        $this->assertModelData($fakebank, $dbbank->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletebank()
    {
        $bank = $this->makebank();
        $resp = $this->bankRepo->delete($bank->id);
        $this->assertTrue($resp);
        $this->assertNull(bank::find($bank->id), 'bank should not exist in DB');
    }
}
