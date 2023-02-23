<?php

use App\Models\InmuebleImagesids;
use App\Repositories\InmuebleImagesidsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class InmuebleImagesidsRepositoryTest extends TestCase
{
    use MakeInmuebleImagesidsTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var InmuebleImagesidsRepository
     */
    protected $inmuebleImagesidsRepo;

    public function setUp()
    {
        parent::setUp();
        $this->inmuebleImagesidsRepo = App::make(InmuebleImagesidsRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateInmuebleImagesids()
    {
        $inmuebleImagesids = $this->fakeInmuebleImagesidsData();
        $createdInmuebleImagesids = $this->inmuebleImagesidsRepo->create($inmuebleImagesids);
        $createdInmuebleImagesids = $createdInmuebleImagesids->toArray();
        $this->assertArrayHasKey('id', $createdInmuebleImagesids);
        $this->assertNotNull($createdInmuebleImagesids['id'], 'Created InmuebleImagesids must have id specified');
        $this->assertNotNull(InmuebleImagesids::find($createdInmuebleImagesids['id']), 'InmuebleImagesids with given id must be in DB');
        $this->assertModelData($inmuebleImagesids, $createdInmuebleImagesids);
    }

    /**
     * @test read
     */
    public function testReadInmuebleImagesids()
    {
        $inmuebleImagesids = $this->makeInmuebleImagesids();
        $dbInmuebleImagesids = $this->inmuebleImagesidsRepo->find($inmuebleImagesids->id);
        $dbInmuebleImagesids = $dbInmuebleImagesids->toArray();
        $this->assertModelData($inmuebleImagesids->toArray(), $dbInmuebleImagesids);
    }

    /**
     * @test update
     */
    public function testUpdateInmuebleImagesids()
    {
        $inmuebleImagesids = $this->makeInmuebleImagesids();
        $fakeInmuebleImagesids = $this->fakeInmuebleImagesidsData();
        $updatedInmuebleImagesids = $this->inmuebleImagesidsRepo->update($fakeInmuebleImagesids, $inmuebleImagesids->id);
        $this->assertModelData($fakeInmuebleImagesids, $updatedInmuebleImagesids->toArray());
        $dbInmuebleImagesids = $this->inmuebleImagesidsRepo->find($inmuebleImagesids->id);
        $this->assertModelData($fakeInmuebleImagesids, $dbInmuebleImagesids->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteInmuebleImagesids()
    {
        $inmuebleImagesids = $this->makeInmuebleImagesids();
        $resp = $this->inmuebleImagesidsRepo->delete($inmuebleImagesids->id);
        $this->assertTrue($resp);
        $this->assertNull(InmuebleImagesids::find($inmuebleImagesids->id), 'InmuebleImagesids should not exist in DB');
    }
}
