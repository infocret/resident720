<?php

use App\Models\propertyareas;
use App\Repositories\propertyareasRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class propertyareasRepositoryTest extends TestCase
{
    use MakepropertyareasTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var propertyareasRepository
     */
    protected $propertyareasRepo;

    public function setUp()
    {
        parent::setUp();
        $this->propertyareasRepo = App::make(propertyareasRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatepropertyareas()
    {
        $propertyareas = $this->fakepropertyareasData();
        $createdpropertyareas = $this->propertyareasRepo->create($propertyareas);
        $createdpropertyareas = $createdpropertyareas->toArray();
        $this->assertArrayHasKey('id', $createdpropertyareas);
        $this->assertNotNull($createdpropertyareas['id'], 'Created propertyareas must have id specified');
        $this->assertNotNull(propertyareas::find($createdpropertyareas['id']), 'propertyareas with given id must be in DB');
        $this->assertModelData($propertyareas, $createdpropertyareas);
    }

    /**
     * @test read
     */
    public function testReadpropertyareas()
    {
        $propertyareas = $this->makepropertyareas();
        $dbpropertyareas = $this->propertyareasRepo->find($propertyareas->id);
        $dbpropertyareas = $dbpropertyareas->toArray();
        $this->assertModelData($propertyareas->toArray(), $dbpropertyareas);
    }

    /**
     * @test update
     */
    public function testUpdatepropertyareas()
    {
        $propertyareas = $this->makepropertyareas();
        $fakepropertyareas = $this->fakepropertyareasData();
        $updatedpropertyareas = $this->propertyareasRepo->update($fakepropertyareas, $propertyareas->id);
        $this->assertModelData($fakepropertyareas, $updatedpropertyareas->toArray());
        $dbpropertyareas = $this->propertyareasRepo->find($propertyareas->id);
        $this->assertModelData($fakepropertyareas, $dbpropertyareas->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletepropertyareas()
    {
        $propertyareas = $this->makepropertyareas();
        $resp = $this->propertyareasRepo->delete($propertyareas->id);
        $this->assertTrue($resp);
        $this->assertNull(propertyareas::find($propertyareas->id), 'propertyareas should not exist in DB');
    }
}
