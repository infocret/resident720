<?php

use App\Models\conceptservice;
use App\Repositories\conceptserviceRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class conceptserviceRepositoryTest extends TestCase
{
    use MakeconceptserviceTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var conceptserviceRepository
     */
    protected $conceptserviceRepo;

    public function setUp()
    {
        parent::setUp();
        $this->conceptserviceRepo = App::make(conceptserviceRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateconceptservice()
    {
        $conceptservice = $this->fakeconceptserviceData();
        $createdconceptservice = $this->conceptserviceRepo->create($conceptservice);
        $createdconceptservice = $createdconceptservice->toArray();
        $this->assertArrayHasKey('id', $createdconceptservice);
        $this->assertNotNull($createdconceptservice['id'], 'Created conceptservice must have id specified');
        $this->assertNotNull(conceptservice::find($createdconceptservice['id']), 'conceptservice with given id must be in DB');
        $this->assertModelData($conceptservice, $createdconceptservice);
    }

    /**
     * @test read
     */
    public function testReadconceptservice()
    {
        $conceptservice = $this->makeconceptservice();
        $dbconceptservice = $this->conceptserviceRepo->find($conceptservice->id);
        $dbconceptservice = $dbconceptservice->toArray();
        $this->assertModelData($conceptservice->toArray(), $dbconceptservice);
    }

    /**
     * @test update
     */
    public function testUpdateconceptservice()
    {
        $conceptservice = $this->makeconceptservice();
        $fakeconceptservice = $this->fakeconceptserviceData();
        $updatedconceptservice = $this->conceptserviceRepo->update($fakeconceptservice, $conceptservice->id);
        $this->assertModelData($fakeconceptservice, $updatedconceptservice->toArray());
        $dbconceptservice = $this->conceptserviceRepo->find($conceptservice->id);
        $this->assertModelData($fakeconceptservice, $dbconceptservice->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteconceptservice()
    {
        $conceptservice = $this->makeconceptservice();
        $resp = $this->conceptserviceRepo->delete($conceptservice->id);
        $this->assertTrue($resp);
        $this->assertNull(conceptservice::find($conceptservice->id), 'conceptservice should not exist in DB');
    }
}
