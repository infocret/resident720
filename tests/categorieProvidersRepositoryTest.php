<?php

use App\Models\categorieProviders;
use App\Repositories\categorieProvidersRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class categorieProvidersRepositoryTest extends TestCase
{
    use MakecategorieProvidersTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var categorieProvidersRepository
     */
    protected $categorieProvidersRepo;

    public function setUp()
    {
        parent::setUp();
        $this->categorieProvidersRepo = App::make(categorieProvidersRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatecategorieProviders()
    {
        $categorieProviders = $this->fakecategorieProvidersData();
        $createdcategorieProviders = $this->categorieProvidersRepo->create($categorieProviders);
        $createdcategorieProviders = $createdcategorieProviders->toArray();
        $this->assertArrayHasKey('id', $createdcategorieProviders);
        $this->assertNotNull($createdcategorieProviders['id'], 'Created categorieProviders must have id specified');
        $this->assertNotNull(categorieProviders::find($createdcategorieProviders['id']), 'categorieProviders with given id must be in DB');
        $this->assertModelData($categorieProviders, $createdcategorieProviders);
    }

    /**
     * @test read
     */
    public function testReadcategorieProviders()
    {
        $categorieProviders = $this->makecategorieProviders();
        $dbcategorieProviders = $this->categorieProvidersRepo->find($categorieProviders->id);
        $dbcategorieProviders = $dbcategorieProviders->toArray();
        $this->assertModelData($categorieProviders->toArray(), $dbcategorieProviders);
    }

    /**
     * @test update
     */
    public function testUpdatecategorieProviders()
    {
        $categorieProviders = $this->makecategorieProviders();
        $fakecategorieProviders = $this->fakecategorieProvidersData();
        $updatedcategorieProviders = $this->categorieProvidersRepo->update($fakecategorieProviders, $categorieProviders->id);
        $this->assertModelData($fakecategorieProviders, $updatedcategorieProviders->toArray());
        $dbcategorieProviders = $this->categorieProvidersRepo->find($categorieProviders->id);
        $this->assertModelData($fakecategorieProviders, $dbcategorieProviders->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletecategorieProviders()
    {
        $categorieProviders = $this->makecategorieProviders();
        $resp = $this->categorieProvidersRepo->delete($categorieProviders->id);
        $this->assertTrue($resp);
        $this->assertNull(categorieProviders::find($categorieProviders->id), 'categorieProviders should not exist in DB');
    }
}
