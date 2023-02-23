<?php

use App\Models\unidadmovto;
use App\Repositories\unidadmovtoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class unidadmovtoRepositoryTest extends TestCase
{
    use MakeunidadmovtoTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var unidadmovtoRepository
     */
    protected $unidadmovtoRepo;

    public function setUp()
    {
        parent::setUp();
        $this->unidadmovtoRepo = App::make(unidadmovtoRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateunidadmovto()
    {
        $unidadmovto = $this->fakeunidadmovtoData();
        $createdunidadmovto = $this->unidadmovtoRepo->create($unidadmovto);
        $createdunidadmovto = $createdunidadmovto->toArray();
        $this->assertArrayHasKey('id', $createdunidadmovto);
        $this->assertNotNull($createdunidadmovto['id'], 'Created unidadmovto must have id specified');
        $this->assertNotNull(unidadmovto::find($createdunidadmovto['id']), 'unidadmovto with given id must be in DB');
        $this->assertModelData($unidadmovto, $createdunidadmovto);
    }

    /**
     * @test read
     */
    public function testReadunidadmovto()
    {
        $unidadmovto = $this->makeunidadmovto();
        $dbunidadmovto = $this->unidadmovtoRepo->find($unidadmovto->id);
        $dbunidadmovto = $dbunidadmovto->toArray();
        $this->assertModelData($unidadmovto->toArray(), $dbunidadmovto);
    }

    /**
     * @test update
     */
    public function testUpdateunidadmovto()
    {
        $unidadmovto = $this->makeunidadmovto();
        $fakeunidadmovto = $this->fakeunidadmovtoData();
        $updatedunidadmovto = $this->unidadmovtoRepo->update($fakeunidadmovto, $unidadmovto->id);
        $this->assertModelData($fakeunidadmovto, $updatedunidadmovto->toArray());
        $dbunidadmovto = $this->unidadmovtoRepo->find($unidadmovto->id);
        $this->assertModelData($fakeunidadmovto, $dbunidadmovto->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteunidadmovto()
    {
        $unidadmovto = $this->makeunidadmovto();
        $resp = $this->unidadmovtoRepo->delete($unidadmovto->id);
        $this->assertTrue($resp);
        $this->assertNull(unidadmovto::find($unidadmovto->id), 'unidadmovto should not exist in DB');
    }
}
