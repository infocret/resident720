<?php

use App\Models\headmov;
use App\Repositories\headmovRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class headmovRepositoryTest extends TestCase
{
    use MakeheadmovTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var headmovRepository
     */
    protected $headmovRepo;

    public function setUp()
    {
        parent::setUp();
        $this->headmovRepo = App::make(headmovRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateheadmov()
    {
        $headmov = $this->fakeheadmovData();
        $createdheadmov = $this->headmovRepo->create($headmov);
        $createdheadmov = $createdheadmov->toArray();
        $this->assertArrayHasKey('id', $createdheadmov);
        $this->assertNotNull($createdheadmov['id'], 'Created headmov must have id specified');
        $this->assertNotNull(headmov::find($createdheadmov['id']), 'headmov with given id must be in DB');
        $this->assertModelData($headmov, $createdheadmov);
    }

    /**
     * @test read
     */
    public function testReadheadmov()
    {
        $headmov = $this->makeheadmov();
        $dbheadmov = $this->headmovRepo->find($headmov->id);
        $dbheadmov = $dbheadmov->toArray();
        $this->assertModelData($headmov->toArray(), $dbheadmov);
    }

    /**
     * @test update
     */
    public function testUpdateheadmov()
    {
        $headmov = $this->makeheadmov();
        $fakeheadmov = $this->fakeheadmovData();
        $updatedheadmov = $this->headmovRepo->update($fakeheadmov, $headmov->id);
        $this->assertModelData($fakeheadmov, $updatedheadmov->toArray());
        $dbheadmov = $this->headmovRepo->find($headmov->id);
        $this->assertModelData($fakeheadmov, $dbheadmov->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteheadmov()
    {
        $headmov = $this->makeheadmov();
        $resp = $this->headmovRepo->delete($headmov->id);
        $this->assertTrue($resp);
        $this->assertNull(headmov::find($headmov->id), 'headmov should not exist in DB');
    }
}
