<?php

use App\Models\propertyparameter;
use App\Repositories\propertyparameterRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class propertyparameterRepositoryTest extends TestCase
{
    use MakepropertyparameterTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var propertyparameterRepository
     */
    protected $propertyparameterRepo;

    public function setUp()
    {
        parent::setUp();
        $this->propertyparameterRepo = App::make(propertyparameterRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatepropertyparameter()
    {
        $propertyparameter = $this->fakepropertyparameterData();
        $createdpropertyparameter = $this->propertyparameterRepo->create($propertyparameter);
        $createdpropertyparameter = $createdpropertyparameter->toArray();
        $this->assertArrayHasKey('id', $createdpropertyparameter);
        $this->assertNotNull($createdpropertyparameter['id'], 'Created propertyparameter must have id specified');
        $this->assertNotNull(propertyparameter::find($createdpropertyparameter['id']), 'propertyparameter with given id must be in DB');
        $this->assertModelData($propertyparameter, $createdpropertyparameter);
    }

    /**
     * @test read
     */
    public function testReadpropertyparameter()
    {
        $propertyparameter = $this->makepropertyparameter();
        $dbpropertyparameter = $this->propertyparameterRepo->find($propertyparameter->id);
        $dbpropertyparameter = $dbpropertyparameter->toArray();
        $this->assertModelData($propertyparameter->toArray(), $dbpropertyparameter);
    }

    /**
     * @test update
     */
    public function testUpdatepropertyparameter()
    {
        $propertyparameter = $this->makepropertyparameter();
        $fakepropertyparameter = $this->fakepropertyparameterData();
        $updatedpropertyparameter = $this->propertyparameterRepo->update($fakepropertyparameter, $propertyparameter->id);
        $this->assertModelData($fakepropertyparameter, $updatedpropertyparameter->toArray());
        $dbpropertyparameter = $this->propertyparameterRepo->find($propertyparameter->id);
        $this->assertModelData($fakepropertyparameter, $dbpropertyparameter->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletepropertyparameter()
    {
        $propertyparameter = $this->makepropertyparameter();
        $resp = $this->propertyparameterRepo->delete($propertyparameter->id);
        $this->assertTrue($resp);
        $this->assertNull(propertyparameter::find($propertyparameter->id), 'propertyparameter should not exist in DB');
    }
}
