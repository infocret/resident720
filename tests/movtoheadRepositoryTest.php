<?php

use App\Models\movtohead;
use App\Repositories\movtoheadRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class movtoheadRepositoryTest extends TestCase
{
    use MakemovtoheadTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var movtoheadRepository
     */
    protected $movtoheadRepo;

    public function setUp()
    {
        parent::setUp();
        $this->movtoheadRepo = App::make(movtoheadRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatemovtohead()
    {
        $movtohead = $this->fakemovtoheadData();
        $createdmovtohead = $this->movtoheadRepo->create($movtohead);
        $createdmovtohead = $createdmovtohead->toArray();
        $this->assertArrayHasKey('id', $createdmovtohead);
        $this->assertNotNull($createdmovtohead['id'], 'Created movtohead must have id specified');
        $this->assertNotNull(movtohead::find($createdmovtohead['id']), 'movtohead with given id must be in DB');
        $this->assertModelData($movtohead, $createdmovtohead);
    }

    /**
     * @test read
     */
    public function testReadmovtohead()
    {
        $movtohead = $this->makemovtohead();
        $dbmovtohead = $this->movtoheadRepo->find($movtohead->id);
        $dbmovtohead = $dbmovtohead->toArray();
        $this->assertModelData($movtohead->toArray(), $dbmovtohead);
    }

    /**
     * @test update
     */
    public function testUpdatemovtohead()
    {
        $movtohead = $this->makemovtohead();
        $fakemovtohead = $this->fakemovtoheadData();
        $updatedmovtohead = $this->movtoheadRepo->update($fakemovtohead, $movtohead->id);
        $this->assertModelData($fakemovtohead, $updatedmovtohead->toArray());
        $dbmovtohead = $this->movtoheadRepo->find($movtohead->id);
        $this->assertModelData($fakemovtohead, $dbmovtohead->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletemovtohead()
    {
        $movtohead = $this->makemovtohead();
        $resp = $this->movtoheadRepo->delete($movtohead->id);
        $this->assertTrue($resp);
        $this->assertNull(movtohead::find($movtohead->id), 'movtohead should not exist in DB');
    }
}
