<?php

use App\Models\propertyservice;
use App\Repositories\propertyserviceRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class propertyserviceRepositoryTest extends TestCase
{
    use MakepropertyserviceTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var propertyserviceRepository
     */
    protected $propertyserviceRepo;

    public function setUp()
    {
        parent::setUp();
        $this->propertyserviceRepo = App::make(propertyserviceRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatepropertyservice()
    {
        $propertyservice = $this->fakepropertyserviceData();
        $createdpropertyservice = $this->propertyserviceRepo->create($propertyservice);
        $createdpropertyservice = $createdpropertyservice->toArray();
        $this->assertArrayHasKey('id', $createdpropertyservice);
        $this->assertNotNull($createdpropertyservice['id'], 'Created propertyservice must have id specified');
        $this->assertNotNull(propertyservice::find($createdpropertyservice['id']), 'propertyservice with given id must be in DB');
        $this->assertModelData($propertyservice, $createdpropertyservice);
    }

    /**
     * @test read
     */
    public function testReadpropertyservice()
    {
        $propertyservice = $this->makepropertyservice();
        $dbpropertyservice = $this->propertyserviceRepo->find($propertyservice->id);
        $dbpropertyservice = $dbpropertyservice->toArray();
        $this->assertModelData($propertyservice->toArray(), $dbpropertyservice);
    }

    /**
     * @test update
     */
    public function testUpdatepropertyservice()
    {
        $propertyservice = $this->makepropertyservice();
        $fakepropertyservice = $this->fakepropertyserviceData();
        $updatedpropertyservice = $this->propertyserviceRepo->update($fakepropertyservice, $propertyservice->id);
        $this->assertModelData($fakepropertyservice, $updatedpropertyservice->toArray());
        $dbpropertyservice = $this->propertyserviceRepo->find($propertyservice->id);
        $this->assertModelData($fakepropertyservice, $dbpropertyservice->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletepropertyservice()
    {
        $propertyservice = $this->makepropertyservice();
        $resp = $this->propertyserviceRepo->delete($propertyservice->id);
        $this->assertTrue($resp);
        $this->assertNull(propertyservice::find($propertyservice->id), 'propertyservice should not exist in DB');
    }
}
