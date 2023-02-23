<?php

use App\Models\service;
use App\Repositories\serviceRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class serviceRepositoryTest extends TestCase
{
    use MakeserviceTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var serviceRepository
     */
    protected $serviceRepo;

    public function setUp()
    {
        parent::setUp();
        $this->serviceRepo = App::make(serviceRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateservice()
    {
        $service = $this->fakeserviceData();
        $createdservice = $this->serviceRepo->create($service);
        $createdservice = $createdservice->toArray();
        $this->assertArrayHasKey('id', $createdservice);
        $this->assertNotNull($createdservice['id'], 'Created service must have id specified');
        $this->assertNotNull(service::find($createdservice['id']), 'service with given id must be in DB');
        $this->assertModelData($service, $createdservice);
    }

    /**
     * @test read
     */
    public function testReadservice()
    {
        $service = $this->makeservice();
        $dbservice = $this->serviceRepo->find($service->id);
        $dbservice = $dbservice->toArray();
        $this->assertModelData($service->toArray(), $dbservice);
    }

    /**
     * @test update
     */
    public function testUpdateservice()
    {
        $service = $this->makeservice();
        $fakeservice = $this->fakeserviceData();
        $updatedservice = $this->serviceRepo->update($fakeservice, $service->id);
        $this->assertModelData($fakeservice, $updatedservice->toArray());
        $dbservice = $this->serviceRepo->find($service->id);
        $this->assertModelData($fakeservice, $dbservice->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteservice()
    {
        $service = $this->makeservice();
        $resp = $this->serviceRepo->delete($service->id);
        $this->assertTrue($resp);
        $this->assertNull(service::find($service->id), 'service should not exist in DB');
    }
}
