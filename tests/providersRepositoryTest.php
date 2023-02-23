<?php

use App\Models\providers;
use App\Repositories\providersRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class providersRepositoryTest extends TestCase
{
    use MakeprovidersTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var providersRepository
     */
    protected $providersRepo;

    public function setUp()
    {
        parent::setUp();
        $this->providersRepo = App::make(providersRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateproviders()
    {
        $providers = $this->fakeprovidersData();
        $createdproviders = $this->providersRepo->create($providers);
        $createdproviders = $createdproviders->toArray();
        $this->assertArrayHasKey('id', $createdproviders);
        $this->assertNotNull($createdproviders['id'], 'Created providers must have id specified');
        $this->assertNotNull(providers::find($createdproviders['id']), 'providers with given id must be in DB');
        $this->assertModelData($providers, $createdproviders);
    }

    /**
     * @test read
     */
    public function testReadproviders()
    {
        $providers = $this->makeproviders();
        $dbproviders = $this->providersRepo->find($providers->id);
        $dbproviders = $dbproviders->toArray();
        $this->assertModelData($providers->toArray(), $dbproviders);
    }

    /**
     * @test update
     */
    public function testUpdateproviders()
    {
        $providers = $this->makeproviders();
        $fakeproviders = $this->fakeprovidersData();
        $updatedproviders = $this->providersRepo->update($fakeproviders, $providers->id);
        $this->assertModelData($fakeproviders, $updatedproviders->toArray());
        $dbproviders = $this->providersRepo->find($providers->id);
        $this->assertModelData($fakeproviders, $dbproviders->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteproviders()
    {
        $providers = $this->makeproviders();
        $resp = $this->providersRepo->delete($providers->id);
        $this->assertTrue($resp);
        $this->assertNull(providers::find($providers->id), 'providers should not exist in DB');
    }
}
