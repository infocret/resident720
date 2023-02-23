<?php

use App\Models\propaccount;
use App\Repositories\propaccountRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class propaccountRepositoryTest extends TestCase
{
    use MakepropaccountTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var propaccountRepository
     */
    protected $propaccountRepo;

    public function setUp()
    {
        parent::setUp();
        $this->propaccountRepo = App::make(propaccountRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatepropaccount()
    {
        $propaccount = $this->fakepropaccountData();
        $createdpropaccount = $this->propaccountRepo->create($propaccount);
        $createdpropaccount = $createdpropaccount->toArray();
        $this->assertArrayHasKey('id', $createdpropaccount);
        $this->assertNotNull($createdpropaccount['id'], 'Created propaccount must have id specified');
        $this->assertNotNull(propaccount::find($createdpropaccount['id']), 'propaccount with given id must be in DB');
        $this->assertModelData($propaccount, $createdpropaccount);
    }

    /**
     * @test read
     */
    public function testReadpropaccount()
    {
        $propaccount = $this->makepropaccount();
        $dbpropaccount = $this->propaccountRepo->find($propaccount->id);
        $dbpropaccount = $dbpropaccount->toArray();
        $this->assertModelData($propaccount->toArray(), $dbpropaccount);
    }

    /**
     * @test update
     */
    public function testUpdatepropaccount()
    {
        $propaccount = $this->makepropaccount();
        $fakepropaccount = $this->fakepropaccountData();
        $updatedpropaccount = $this->propaccountRepo->update($fakepropaccount, $propaccount->id);
        $this->assertModelData($fakepropaccount, $updatedpropaccount->toArray());
        $dbpropaccount = $this->propaccountRepo->find($propaccount->id);
        $this->assertModelData($fakepropaccount, $dbpropaccount->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletepropaccount()
    {
        $propaccount = $this->makepropaccount();
        $resp = $this->propaccountRepo->delete($propaccount->id);
        $this->assertTrue($resp);
        $this->assertNull(propaccount::find($propaccount->id), 'propaccount should not exist in DB');
    }
}
