<?php

use App\Models\movdetailapplie;
use App\Repositories\movdetailapplieRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class movdetailapplieRepositoryTest extends TestCase
{
    use MakemovdetailapplieTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var movdetailapplieRepository
     */
    protected $movdetailapplieRepo;

    public function setUp()
    {
        parent::setUp();
        $this->movdetailapplieRepo = App::make(movdetailapplieRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatemovdetailapplie()
    {
        $movdetailapplie = $this->fakemovdetailapplieData();
        $createdmovdetailapplie = $this->movdetailapplieRepo->create($movdetailapplie);
        $createdmovdetailapplie = $createdmovdetailapplie->toArray();
        $this->assertArrayHasKey('id', $createdmovdetailapplie);
        $this->assertNotNull($createdmovdetailapplie['id'], 'Created movdetailapplie must have id specified');
        $this->assertNotNull(movdetailapplie::find($createdmovdetailapplie['id']), 'movdetailapplie with given id must be in DB');
        $this->assertModelData($movdetailapplie, $createdmovdetailapplie);
    }

    /**
     * @test read
     */
    public function testReadmovdetailapplie()
    {
        $movdetailapplie = $this->makemovdetailapplie();
        $dbmovdetailapplie = $this->movdetailapplieRepo->find($movdetailapplie->id);
        $dbmovdetailapplie = $dbmovdetailapplie->toArray();
        $this->assertModelData($movdetailapplie->toArray(), $dbmovdetailapplie);
    }

    /**
     * @test update
     */
    public function testUpdatemovdetailapplie()
    {
        $movdetailapplie = $this->makemovdetailapplie();
        $fakemovdetailapplie = $this->fakemovdetailapplieData();
        $updatedmovdetailapplie = $this->movdetailapplieRepo->update($fakemovdetailapplie, $movdetailapplie->id);
        $this->assertModelData($fakemovdetailapplie, $updatedmovdetailapplie->toArray());
        $dbmovdetailapplie = $this->movdetailapplieRepo->find($movdetailapplie->id);
        $this->assertModelData($fakemovdetailapplie, $dbmovdetailapplie->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletemovdetailapplie()
    {
        $movdetailapplie = $this->makemovdetailapplie();
        $resp = $this->movdetailapplieRepo->delete($movdetailapplie->id);
        $this->assertTrue($resp);
        $this->assertNull(movdetailapplie::find($movdetailapplie->id), 'movdetailapplie should not exist in DB');
    }
}
