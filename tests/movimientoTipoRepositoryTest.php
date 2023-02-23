<?php

use App\Models\movimientoTipo;
use App\Repositories\movimientoTipoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class movimientoTipoRepositoryTest extends TestCase
{
    use MakemovimientoTipoTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var movimientoTipoRepository
     */
    protected $movimientoTipoRepo;

    public function setUp()
    {
        parent::setUp();
        $this->movimientoTipoRepo = App::make(movimientoTipoRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatemovimientoTipo()
    {
        $movimientoTipo = $this->fakemovimientoTipoData();
        $createdmovimientoTipo = $this->movimientoTipoRepo->create($movimientoTipo);
        $createdmovimientoTipo = $createdmovimientoTipo->toArray();
        $this->assertArrayHasKey('id', $createdmovimientoTipo);
        $this->assertNotNull($createdmovimientoTipo['id'], 'Created movimientoTipo must have id specified');
        $this->assertNotNull(movimientoTipo::find($createdmovimientoTipo['id']), 'movimientoTipo with given id must be in DB');
        $this->assertModelData($movimientoTipo, $createdmovimientoTipo);
    }

    /**
     * @test read
     */
    public function testReadmovimientoTipo()
    {
        $movimientoTipo = $this->makemovimientoTipo();
        $dbmovimientoTipo = $this->movimientoTipoRepo->find($movimientoTipo->id);
        $dbmovimientoTipo = $dbmovimientoTipo->toArray();
        $this->assertModelData($movimientoTipo->toArray(), $dbmovimientoTipo);
    }

    /**
     * @test update
     */
    public function testUpdatemovimientoTipo()
    {
        $movimientoTipo = $this->makemovimientoTipo();
        $fakemovimientoTipo = $this->fakemovimientoTipoData();
        $updatedmovimientoTipo = $this->movimientoTipoRepo->update($fakemovimientoTipo, $movimientoTipo->id);
        $this->assertModelData($fakemovimientoTipo, $updatedmovimientoTipo->toArray());
        $dbmovimientoTipo = $this->movimientoTipoRepo->find($movimientoTipo->id);
        $this->assertModelData($fakemovimientoTipo, $dbmovimientoTipo->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletemovimientoTipo()
    {
        $movimientoTipo = $this->makemovimientoTipo();
        $resp = $this->movimientoTipoRepo->delete($movimientoTipo->id);
        $this->assertTrue($resp);
        $this->assertNull(movimientoTipo::find($movimientoTipo->id), 'movimientoTipo should not exist in DB');
    }
}
