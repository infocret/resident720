<?php

use App\Models\detailmov;
use App\Repositories\detailmovRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class detailmovRepositoryTest extends TestCase
{
    use MakedetailmovTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var detailmovRepository
     */
    protected $detailmovRepo;

    public function setUp()
    {
        parent::setUp();
        $this->detailmovRepo = App::make(detailmovRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatedetailmov()
    {
        $detailmov = $this->fakedetailmovData();
        $createddetailmov = $this->detailmovRepo->create($detailmov);
        $createddetailmov = $createddetailmov->toArray();
        $this->assertArrayHasKey('id', $createddetailmov);
        $this->assertNotNull($createddetailmov['id'], 'Created detailmov must have id specified');
        $this->assertNotNull(detailmov::find($createddetailmov['id']), 'detailmov with given id must be in DB');
        $this->assertModelData($detailmov, $createddetailmov);
    }

    /**
     * @test read
     */
    public function testReaddetailmov()
    {
        $detailmov = $this->makedetailmov();
        $dbdetailmov = $this->detailmovRepo->find($detailmov->id);
        $dbdetailmov = $dbdetailmov->toArray();
        $this->assertModelData($detailmov->toArray(), $dbdetailmov);
    }

    /**
     * @test update
     */
    public function testUpdatedetailmov()
    {
        $detailmov = $this->makedetailmov();
        $fakedetailmov = $this->fakedetailmovData();
        $updateddetailmov = $this->detailmovRepo->update($fakedetailmov, $detailmov->id);
        $this->assertModelData($fakedetailmov, $updateddetailmov->toArray());
        $dbdetailmov = $this->detailmovRepo->find($detailmov->id);
        $this->assertModelData($fakedetailmov, $dbdetailmov->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletedetailmov()
    {
        $detailmov = $this->makedetailmov();
        $resp = $this->detailmovRepo->delete($detailmov->id);
        $this->assertTrue($resp);
        $this->assertNull(detailmov::find($detailmov->id), 'detailmov should not exist in DB');
    }
}
