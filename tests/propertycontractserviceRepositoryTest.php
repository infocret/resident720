<?php

use App\Models\propertycontractservice;
use App\Repositories\propertycontractserviceRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class propertycontractserviceRepositoryTest extends TestCase
{
    use MakepropertycontractserviceTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var propertycontractserviceRepository
     */
    protected $propertycontractserviceRepo;

    public function setUp()
    {
        parent::setUp();
        $this->propertycontractserviceRepo = App::make(propertycontractserviceRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatepropertycontractservice()
    {
        $propertycontractservice = $this->fakepropertycontractserviceData();
        $createdpropertycontractservice = $this->propertycontractserviceRepo->create($propertycontractservice);
        $createdpropertycontractservice = $createdpropertycontractservice->toArray();
        $this->assertArrayHasKey('id', $createdpropertycontractservice);
        $this->assertNotNull($createdpropertycontractservice['id'], 'Created propertycontractservice must have id specified');
        $this->assertNotNull(propertycontractservice::find($createdpropertycontractservice['id']), 'propertycontractservice with given id must be in DB');
        $this->assertModelData($propertycontractservice, $createdpropertycontractservice);
    }

    /**
     * @test read
     */
    public function testReadpropertycontractservice()
    {
        $propertycontractservice = $this->makepropertycontractservice();
        $dbpropertycontractservice = $this->propertycontractserviceRepo->find($propertycontractservice->id);
        $dbpropertycontractservice = $dbpropertycontractservice->toArray();
        $this->assertModelData($propertycontractservice->toArray(), $dbpropertycontractservice);
    }

    /**
     * @test update
     */
    public function testUpdatepropertycontractservice()
    {
        $propertycontractservice = $this->makepropertycontractservice();
        $fakepropertycontractservice = $this->fakepropertycontractserviceData();
        $updatedpropertycontractservice = $this->propertycontractserviceRepo->update($fakepropertycontractservice, $propertycontractservice->id);
        $this->assertModelData($fakepropertycontractservice, $updatedpropertycontractservice->toArray());
        $dbpropertycontractservice = $this->propertycontractserviceRepo->find($propertycontractservice->id);
        $this->assertModelData($fakepropertycontractservice, $dbpropertycontractservice->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletepropertycontractservice()
    {
        $propertycontractservice = $this->makepropertycontractservice();
        $resp = $this->propertycontractserviceRepo->delete($propertycontractservice->id);
        $this->assertTrue($resp);
        $this->assertNull(propertycontractservice::find($propertycontractservice->id), 'propertycontractservice should not exist in DB');
    }
}
