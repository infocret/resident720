<?php

use App\Models\movtodetail;
use App\Repositories\movtodetailRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class movtodetailRepositoryTest extends TestCase
{
    use MakemovtodetailTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var movtodetailRepository
     */
    protected $movtodetailRepo;

    public function setUp()
    {
        parent::setUp();
        $this->movtodetailRepo = App::make(movtodetailRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatemovtodetail()
    {
        $movtodetail = $this->fakemovtodetailData();
        $createdmovtodetail = $this->movtodetailRepo->create($movtodetail);
        $createdmovtodetail = $createdmovtodetail->toArray();
        $this->assertArrayHasKey('id', $createdmovtodetail);
        $this->assertNotNull($createdmovtodetail['id'], 'Created movtodetail must have id specified');
        $this->assertNotNull(movtodetail::find($createdmovtodetail['id']), 'movtodetail with given id must be in DB');
        $this->assertModelData($movtodetail, $createdmovtodetail);
    }

    /**
     * @test read
     */
    public function testReadmovtodetail()
    {
        $movtodetail = $this->makemovtodetail();
        $dbmovtodetail = $this->movtodetailRepo->find($movtodetail->id);
        $dbmovtodetail = $dbmovtodetail->toArray();
        $this->assertModelData($movtodetail->toArray(), $dbmovtodetail);
    }

    /**
     * @test update
     */
    public function testUpdatemovtodetail()
    {
        $movtodetail = $this->makemovtodetail();
        $fakemovtodetail = $this->fakemovtodetailData();
        $updatedmovtodetail = $this->movtodetailRepo->update($fakemovtodetail, $movtodetail->id);
        $this->assertModelData($fakemovtodetail, $updatedmovtodetail->toArray());
        $dbmovtodetail = $this->movtodetailRepo->find($movtodetail->id);
        $this->assertModelData($fakemovtodetail, $dbmovtodetail->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletemovtodetail()
    {
        $movtodetail = $this->makemovtodetail();
        $resp = $this->movtodetailRepo->delete($movtodetail->id);
        $this->assertTrue($resp);
        $this->assertNull(movtodetail::find($movtodetail->id), 'movtodetail should not exist in DB');
    }
}
