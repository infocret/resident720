<?php

use App\Models\inmucharge;
use App\Repositories\inmuchargeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class inmuchargeRepositoryTest extends TestCase
{
    use MakeinmuchargeTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var inmuchargeRepository
     */
    protected $inmuchargeRepo;

    public function setUp()
    {
        parent::setUp();
        $this->inmuchargeRepo = App::make(inmuchargeRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateinmucharge()
    {
        $inmucharge = $this->fakeinmuchargeData();
        $createdinmucharge = $this->inmuchargeRepo->create($inmucharge);
        $createdinmucharge = $createdinmucharge->toArray();
        $this->assertArrayHasKey('id', $createdinmucharge);
        $this->assertNotNull($createdinmucharge['id'], 'Created inmucharge must have id specified');
        $this->assertNotNull(inmucharge::find($createdinmucharge['id']), 'inmucharge with given id must be in DB');
        $this->assertModelData($inmucharge, $createdinmucharge);
    }

    /**
     * @test read
     */
    public function testReadinmucharge()
    {
        $inmucharge = $this->makeinmucharge();
        $dbinmucharge = $this->inmuchargeRepo->find($inmucharge->id);
        $dbinmucharge = $dbinmucharge->toArray();
        $this->assertModelData($inmucharge->toArray(), $dbinmucharge);
    }

    /**
     * @test update
     */
    public function testUpdateinmucharge()
    {
        $inmucharge = $this->makeinmucharge();
        $fakeinmucharge = $this->fakeinmuchargeData();
        $updatedinmucharge = $this->inmuchargeRepo->update($fakeinmucharge, $inmucharge->id);
        $this->assertModelData($fakeinmucharge, $updatedinmucharge->toArray());
        $dbinmucharge = $this->inmuchargeRepo->find($inmucharge->id);
        $this->assertModelData($fakeinmucharge, $dbinmucharge->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteinmucharge()
    {
        $inmucharge = $this->makeinmucharge();
        $resp = $this->inmuchargeRepo->delete($inmucharge->id);
        $this->assertTrue($resp);
        $this->assertNull(inmucharge::find($inmucharge->id), 'inmucharge should not exist in DB');
    }
}
