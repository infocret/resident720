<?php

use App\Models\storage;
use App\Repositories\storageRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class storageRepositoryTest extends TestCase
{
    use MakestorageTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var storageRepository
     */
    protected $storageRepo;

    public function setUp()
    {
        parent::setUp();
        $this->storageRepo = App::make(storageRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatestorage()
    {
        $storage = $this->fakestorageData();
        $createdstorage = $this->storageRepo->create($storage);
        $createdstorage = $createdstorage->toArray();
        $this->assertArrayHasKey('id', $createdstorage);
        $this->assertNotNull($createdstorage['id'], 'Created storage must have id specified');
        $this->assertNotNull(storage::find($createdstorage['id']), 'storage with given id must be in DB');
        $this->assertModelData($storage, $createdstorage);
    }

    /**
     * @test read
     */
    public function testReadstorage()
    {
        $storage = $this->makestorage();
        $dbstorage = $this->storageRepo->find($storage->id);
        $dbstorage = $dbstorage->toArray();
        $this->assertModelData($storage->toArray(), $dbstorage);
    }

    /**
     * @test update
     */
    public function testUpdatestorage()
    {
        $storage = $this->makestorage();
        $fakestorage = $this->fakestorageData();
        $updatedstorage = $this->storageRepo->update($fakestorage, $storage->id);
        $this->assertModelData($fakestorage, $updatedstorage->toArray());
        $dbstorage = $this->storageRepo->find($storage->id);
        $this->assertModelData($fakestorage, $dbstorage->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletestorage()
    {
        $storage = $this->makestorage();
        $resp = $this->storageRepo->delete($storage->id);
        $this->assertTrue($resp);
        $this->assertNull(storage::find($storage->id), 'storage should not exist in DB');
    }
}
