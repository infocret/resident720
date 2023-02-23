<?php

use App\Models\bankaccount;
use App\Repositories\bankaccountRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class bankaccountRepositoryTest extends TestCase
{
    use MakebankaccountTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var bankaccountRepository
     */
    protected $bankaccountRepo;

    public function setUp()
    {
        parent::setUp();
        $this->bankaccountRepo = App::make(bankaccountRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatebankaccount()
    {
        $bankaccount = $this->fakebankaccountData();
        $createdbankaccount = $this->bankaccountRepo->create($bankaccount);
        $createdbankaccount = $createdbankaccount->toArray();
        $this->assertArrayHasKey('id', $createdbankaccount);
        $this->assertNotNull($createdbankaccount['id'], 'Created bankaccount must have id specified');
        $this->assertNotNull(bankaccount::find($createdbankaccount['id']), 'bankaccount with given id must be in DB');
        $this->assertModelData($bankaccount, $createdbankaccount);
    }

    /**
     * @test read
     */
    public function testReadbankaccount()
    {
        $bankaccount = $this->makebankaccount();
        $dbbankaccount = $this->bankaccountRepo->find($bankaccount->id);
        $dbbankaccount = $dbbankaccount->toArray();
        $this->assertModelData($bankaccount->toArray(), $dbbankaccount);
    }

    /**
     * @test update
     */
    public function testUpdatebankaccount()
    {
        $bankaccount = $this->makebankaccount();
        $fakebankaccount = $this->fakebankaccountData();
        $updatedbankaccount = $this->bankaccountRepo->update($fakebankaccount, $bankaccount->id);
        $this->assertModelData($fakebankaccount, $updatedbankaccount->toArray());
        $dbbankaccount = $this->bankaccountRepo->find($bankaccount->id);
        $this->assertModelData($fakebankaccount, $dbbankaccount->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletebankaccount()
    {
        $bankaccount = $this->makebankaccount();
        $resp = $this->bankaccountRepo->delete($bankaccount->id);
        $this->assertTrue($resp);
        $this->assertNull(bankaccount::find($bankaccount->id), 'bankaccount should not exist in DB');
    }
}
