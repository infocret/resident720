<?php

use App\Models\procedmovto;
use App\Repositories\procedmovtoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class procedmovtoRepositoryTest extends TestCase
{
    use MakeprocedmovtoTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var procedmovtoRepository
     */
    protected $procedmovtoRepo;

    public function setUp()
    {
        parent::setUp();
        $this->procedmovtoRepo = App::make(procedmovtoRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateprocedmovto()
    {
        $procedmovto = $this->fakeprocedmovtoData();
        $createdprocedmovto = $this->procedmovtoRepo->create($procedmovto);
        $createdprocedmovto = $createdprocedmovto->toArray();
        $this->assertArrayHasKey('id', $createdprocedmovto);
        $this->assertNotNull($createdprocedmovto['id'], 'Created procedmovto must have id specified');
        $this->assertNotNull(procedmovto::find($createdprocedmovto['id']), 'procedmovto with given id must be in DB');
        $this->assertModelData($procedmovto, $createdprocedmovto);
    }

    /**
     * @test read
     */
    public function testReadprocedmovto()
    {
        $procedmovto = $this->makeprocedmovto();
        $dbprocedmovto = $this->procedmovtoRepo->find($procedmovto->id);
        $dbprocedmovto = $dbprocedmovto->toArray();
        $this->assertModelData($procedmovto->toArray(), $dbprocedmovto);
    }

    /**
     * @test update
     */
    public function testUpdateprocedmovto()
    {
        $procedmovto = $this->makeprocedmovto();
        $fakeprocedmovto = $this->fakeprocedmovtoData();
        $updatedprocedmovto = $this->procedmovtoRepo->update($fakeprocedmovto, $procedmovto->id);
        $this->assertModelData($fakeprocedmovto, $updatedprocedmovto->toArray());
        $dbprocedmovto = $this->procedmovtoRepo->find($procedmovto->id);
        $this->assertModelData($fakeprocedmovto, $dbprocedmovto->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteprocedmovto()
    {
        $procedmovto = $this->makeprocedmovto();
        $resp = $this->procedmovtoRepo->delete($procedmovto->id);
        $this->assertTrue($resp);
        $this->assertNull(procedmovto::find($procedmovto->id), 'procedmovto should not exist in DB');
    }
}
