<?php

use App\Models\movtobankaccount;
use App\Repositories\movtobankaccountRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class movtobankaccountRepositoryTest extends TestCase
{
    use MakemovtobankaccountTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var movtobankaccountRepository
     */
    protected $movtobankaccountRepo;

    public function setUp()
    {
        parent::setUp();
        $this->movtobankaccountRepo = App::make(movtobankaccountRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatemovtobankaccount()
    {
        $movtobankaccount = $this->fakemovtobankaccountData();
        $createdmovtobankaccount = $this->movtobankaccountRepo->create($movtobankaccount);
        $createdmovtobankaccount = $createdmovtobankaccount->toArray();
        $this->assertArrayHasKey('id', $createdmovtobankaccount);
        $this->assertNotNull($createdmovtobankaccount['id'], 'Created movtobankaccount must have id specified');
        $this->assertNotNull(movtobankaccount::find($createdmovtobankaccount['id']), 'movtobankaccount with given id must be in DB');
        $this->assertModelData($movtobankaccount, $createdmovtobankaccount);
    }

    /**
     * @test read
     */
    public function testReadmovtobankaccount()
    {
        $movtobankaccount = $this->makemovtobankaccount();
        $dbmovtobankaccount = $this->movtobankaccountRepo->find($movtobankaccount->id);
        $dbmovtobankaccount = $dbmovtobankaccount->toArray();
        $this->assertModelData($movtobankaccount->toArray(), $dbmovtobankaccount);
    }

    /**
     * @test update
     */
    public function testUpdatemovtobankaccount()
    {
        $movtobankaccount = $this->makemovtobankaccount();
        $fakemovtobankaccount = $this->fakemovtobankaccountData();
        $updatedmovtobankaccount = $this->movtobankaccountRepo->update($fakemovtobankaccount, $movtobankaccount->id);
        $this->assertModelData($fakemovtobankaccount, $updatedmovtobankaccount->toArray());
        $dbmovtobankaccount = $this->movtobankaccountRepo->find($movtobankaccount->id);
        $this->assertModelData($fakemovtobankaccount, $dbmovtobankaccount->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletemovtobankaccount()
    {
        $movtobankaccount = $this->makemovtobankaccount();
        $resp = $this->movtobankaccountRepo->delete($movtobankaccount->id);
        $this->assertTrue($resp);
        $this->assertNull(movtobankaccount::find($movtobankaccount->id), 'movtobankaccount should not exist in DB');
    }
}
