<?php

use App\Models\presupuesto;
use App\Repositories\presupuestoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class presupuestoRepositoryTest extends TestCase
{
    use MakepresupuestoTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var presupuestoRepository
     */
    protected $presupuestoRepo;

    public function setUp()
    {
        parent::setUp();
        $this->presupuestoRepo = App::make(presupuestoRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatepresupuesto()
    {
        $presupuesto = $this->fakepresupuestoData();
        $createdpresupuesto = $this->presupuestoRepo->create($presupuesto);
        $createdpresupuesto = $createdpresupuesto->toArray();
        $this->assertArrayHasKey('id', $createdpresupuesto);
        $this->assertNotNull($createdpresupuesto['id'], 'Created presupuesto must have id specified');
        $this->assertNotNull(presupuesto::find($createdpresupuesto['id']), 'presupuesto with given id must be in DB');
        $this->assertModelData($presupuesto, $createdpresupuesto);
    }

    /**
     * @test read
     */
    public function testReadpresupuesto()
    {
        $presupuesto = $this->makepresupuesto();
        $dbpresupuesto = $this->presupuestoRepo->find($presupuesto->id);
        $dbpresupuesto = $dbpresupuesto->toArray();
        $this->assertModelData($presupuesto->toArray(), $dbpresupuesto);
    }

    /**
     * @test update
     */
    public function testUpdatepresupuesto()
    {
        $presupuesto = $this->makepresupuesto();
        $fakepresupuesto = $this->fakepresupuestoData();
        $updatedpresupuesto = $this->presupuestoRepo->update($fakepresupuesto, $presupuesto->id);
        $this->assertModelData($fakepresupuesto, $updatedpresupuesto->toArray());
        $dbpresupuesto = $this->presupuestoRepo->find($presupuesto->id);
        $this->assertModelData($fakepresupuesto, $dbpresupuesto->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletepresupuesto()
    {
        $presupuesto = $this->makepresupuesto();
        $resp = $this->presupuestoRepo->delete($presupuesto->id);
        $this->assertTrue($resp);
        $this->assertNull(presupuesto::find($presupuesto->id), 'presupuesto should not exist in DB');
    }
}
