<?php

use App\Models\catmovto;
use App\Repositories\catmovtoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class catmovtoRepositoryTest extends TestCase
{
    use MakecatmovtoTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var catmovtoRepository
     */
    protected $catmovtoRepo;

    public function setUp()
    {
        parent::setUp();
        $this->catmovtoRepo = App::make(catmovtoRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatecatmovto()
    {
        $catmovto = $this->fakecatmovtoData();
        $createdcatmovto = $this->catmovtoRepo->create($catmovto);
        $createdcatmovto = $createdcatmovto->toArray();
        $this->assertArrayHasKey('id', $createdcatmovto);
        $this->assertNotNull($createdcatmovto['id'], 'Created catmovto must have id specified');
        $this->assertNotNull(catmovto::find($createdcatmovto['id']), 'catmovto with given id must be in DB');
        $this->assertModelData($catmovto, $createdcatmovto);
    }

    /**
     * @test read
     */
    public function testReadcatmovto()
    {
        $catmovto = $this->makecatmovto();
        $dbcatmovto = $this->catmovtoRepo->find($catmovto->id);
        $dbcatmovto = $dbcatmovto->toArray();
        $this->assertModelData($catmovto->toArray(), $dbcatmovto);
    }

    /**
     * @test update
     */
    public function testUpdatecatmovto()
    {
        $catmovto = $this->makecatmovto();
        $fakecatmovto = $this->fakecatmovtoData();
        $updatedcatmovto = $this->catmovtoRepo->update($fakecatmovto, $catmovto->id);
        $this->assertModelData($fakecatmovto, $updatedcatmovto->toArray());
        $dbcatmovto = $this->catmovtoRepo->find($catmovto->id);
        $this->assertModelData($fakecatmovto, $dbcatmovto->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletecatmovto()
    {
        $catmovto = $this->makecatmovto();
        $resp = $this->catmovtoRepo->delete($catmovto->id);
        $this->assertTrue($resp);
        $this->assertNull(catmovto::find($catmovto->id), 'catmovto should not exist in DB');
    }
}
