<?php

use App\Models\propertyvalue;
use App\Repositories\propertyvalueRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class propertyvalueRepositoryTest extends TestCase
{
    use MakepropertyvalueTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var propertyvalueRepository
     */
    protected $propertyvalueRepo;

    public function setUp()
    {
        parent::setUp();
        $this->propertyvalueRepo = App::make(propertyvalueRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatepropertyvalue()
    {
        $propertyvalue = $this->fakepropertyvalueData();
        $createdpropertyvalue = $this->propertyvalueRepo->create($propertyvalue);
        $createdpropertyvalue = $createdpropertyvalue->toArray();
        $this->assertArrayHasKey('id', $createdpropertyvalue);
        $this->assertNotNull($createdpropertyvalue['id'], 'Created propertyvalue must have id specified');
        $this->assertNotNull(propertyvalue::find($createdpropertyvalue['id']), 'propertyvalue with given id must be in DB');
        $this->assertModelData($propertyvalue, $createdpropertyvalue);
    }

    /**
     * @test read
     */
    public function testReadpropertyvalue()
    {
        $propertyvalue = $this->makepropertyvalue();
        $dbpropertyvalue = $this->propertyvalueRepo->find($propertyvalue->id);
        $dbpropertyvalue = $dbpropertyvalue->toArray();
        $this->assertModelData($propertyvalue->toArray(), $dbpropertyvalue);
    }

    /**
     * @test update
     */
    public function testUpdatepropertyvalue()
    {
        $propertyvalue = $this->makepropertyvalue();
        $fakepropertyvalue = $this->fakepropertyvalueData();
        $updatedpropertyvalue = $this->propertyvalueRepo->update($fakepropertyvalue, $propertyvalue->id);
        $this->assertModelData($fakepropertyvalue, $updatedpropertyvalue->toArray());
        $dbpropertyvalue = $this->propertyvalueRepo->find($propertyvalue->id);
        $this->assertModelData($fakepropertyvalue, $dbpropertyvalue->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletepropertyvalue()
    {
        $propertyvalue = $this->makepropertyvalue();
        $resp = $this->propertyvalueRepo->delete($propertyvalue->id);
        $this->assertTrue($resp);
        $this->assertNull(propertyvalue::find($propertyvalue->id), 'propertyvalue should not exist in DB');
    }
}
