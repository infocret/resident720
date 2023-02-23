<?php

use App\Models\provideraccount;
use App\Repositories\provideraccountRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class provideraccountRepositoryTest extends TestCase
{
    use MakeprovideraccountTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var provideraccountRepository
     */
    protected $provideraccountRepo;

    public function setUp()
    {
        parent::setUp();
        $this->provideraccountRepo = App::make(provideraccountRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateprovideraccount()
    {
        $provideraccount = $this->fakeprovideraccountData();
        $createdprovideraccount = $this->provideraccountRepo->create($provideraccount);
        $createdprovideraccount = $createdprovideraccount->toArray();
        $this->assertArrayHasKey('id', $createdprovideraccount);
        $this->assertNotNull($createdprovideraccount['id'], 'Created provideraccount must have id specified');
        $this->assertNotNull(provideraccount::find($createdprovideraccount['id']), 'provideraccount with given id must be in DB');
        $this->assertModelData($provideraccount, $createdprovideraccount);
    }

    /**
     * @test read
     */
    public function testReadprovideraccount()
    {
        $provideraccount = $this->makeprovideraccount();
        $dbprovideraccount = $this->provideraccountRepo->find($provideraccount->id);
        $dbprovideraccount = $dbprovideraccount->toArray();
        $this->assertModelData($provideraccount->toArray(), $dbprovideraccount);
    }

    /**
     * @test update
     */
    public function testUpdateprovideraccount()
    {
        $provideraccount = $this->makeprovideraccount();
        $fakeprovideraccount = $this->fakeprovideraccountData();
        $updatedprovideraccount = $this->provideraccountRepo->update($fakeprovideraccount, $provideraccount->id);
        $this->assertModelData($fakeprovideraccount, $updatedprovideraccount->toArray());
        $dbprovideraccount = $this->provideraccountRepo->find($provideraccount->id);
        $this->assertModelData($fakeprovideraccount, $dbprovideraccount->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteprovideraccount()
    {
        $provideraccount = $this->makeprovideraccount();
        $resp = $this->provideraccountRepo->delete($provideraccount->id);
        $this->assertTrue($resp);
        $this->assertNull(provideraccount::find($provideraccount->id), 'provideraccount should not exist in DB');
    }
}
