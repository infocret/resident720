<?php

use App\Models\conceptservpropaccount;
use App\Repositories\conceptservpropaccountRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class conceptservpropaccountRepositoryTest extends TestCase
{
    use MakeconceptservpropaccountTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var conceptservpropaccountRepository
     */
    protected $conceptservpropaccountRepo;

    public function setUp()
    {
        parent::setUp();
        $this->conceptservpropaccountRepo = App::make(conceptservpropaccountRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateconceptservpropaccount()
    {
        $conceptservpropaccount = $this->fakeconceptservpropaccountData();
        $createdconceptservpropaccount = $this->conceptservpropaccountRepo->create($conceptservpropaccount);
        $createdconceptservpropaccount = $createdconceptservpropaccount->toArray();
        $this->assertArrayHasKey('id', $createdconceptservpropaccount);
        $this->assertNotNull($createdconceptservpropaccount['id'], 'Created conceptservpropaccount must have id specified');
        $this->assertNotNull(conceptservpropaccount::find($createdconceptservpropaccount['id']), 'conceptservpropaccount with given id must be in DB');
        $this->assertModelData($conceptservpropaccount, $createdconceptservpropaccount);
    }

    /**
     * @test read
     */
    public function testReadconceptservpropaccount()
    {
        $conceptservpropaccount = $this->makeconceptservpropaccount();
        $dbconceptservpropaccount = $this->conceptservpropaccountRepo->find($conceptservpropaccount->id);
        $dbconceptservpropaccount = $dbconceptservpropaccount->toArray();
        $this->assertModelData($conceptservpropaccount->toArray(), $dbconceptservpropaccount);
    }

    /**
     * @test update
     */
    public function testUpdateconceptservpropaccount()
    {
        $conceptservpropaccount = $this->makeconceptservpropaccount();
        $fakeconceptservpropaccount = $this->fakeconceptservpropaccountData();
        $updatedconceptservpropaccount = $this->conceptservpropaccountRepo->update($fakeconceptservpropaccount, $conceptservpropaccount->id);
        $this->assertModelData($fakeconceptservpropaccount, $updatedconceptservpropaccount->toArray());
        $dbconceptservpropaccount = $this->conceptservpropaccountRepo->find($conceptservpropaccount->id);
        $this->assertModelData($fakeconceptservpropaccount, $dbconceptservpropaccount->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteconceptservpropaccount()
    {
        $conceptservpropaccount = $this->makeconceptservpropaccount();
        $resp = $this->conceptservpropaccountRepo->delete($conceptservpropaccount->id);
        $this->assertTrue($resp);
        $this->assertNull(conceptservpropaccount::find($conceptservpropaccount->id), 'conceptservpropaccount should not exist in DB');
    }
}
