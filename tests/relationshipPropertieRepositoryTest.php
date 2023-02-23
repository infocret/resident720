<?php

use App\Models\relationshipPropertie;
use App\Repositories\relationshipPropertieRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class relationshipPropertieRepositoryTest extends TestCase
{
    use MakerelationshipPropertieTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var relationshipPropertieRepository
     */
    protected $relationshipPropertieRepo;

    public function setUp()
    {
        parent::setUp();
        $this->relationshipPropertieRepo = App::make(relationshipPropertieRepository::class);
    }

    /**
     * @test create
     */
    public function testCreaterelationshipPropertie()
    {
        $relationshipPropertie = $this->fakerelationshipPropertieData();
        $createdrelationshipPropertie = $this->relationshipPropertieRepo->create($relationshipPropertie);
        $createdrelationshipPropertie = $createdrelationshipPropertie->toArray();
        $this->assertArrayHasKey('id', $createdrelationshipPropertie);
        $this->assertNotNull($createdrelationshipPropertie['id'], 'Created relationshipPropertie must have id specified');
        $this->assertNotNull(relationshipPropertie::find($createdrelationshipPropertie['id']), 'relationshipPropertie with given id must be in DB');
        $this->assertModelData($relationshipPropertie, $createdrelationshipPropertie);
    }

    /**
     * @test read
     */
    public function testReadrelationshipPropertie()
    {
        $relationshipPropertie = $this->makerelationshipPropertie();
        $dbrelationshipPropertie = $this->relationshipPropertieRepo->find($relationshipPropertie->id);
        $dbrelationshipPropertie = $dbrelationshipPropertie->toArray();
        $this->assertModelData($relationshipPropertie->toArray(), $dbrelationshipPropertie);
    }

    /**
     * @test update
     */
    public function testUpdaterelationshipPropertie()
    {
        $relationshipPropertie = $this->makerelationshipPropertie();
        $fakerelationshipPropertie = $this->fakerelationshipPropertieData();
        $updatedrelationshipPropertie = $this->relationshipPropertieRepo->update($fakerelationshipPropertie, $relationshipPropertie->id);
        $this->assertModelData($fakerelationshipPropertie, $updatedrelationshipPropertie->toArray());
        $dbrelationshipPropertie = $this->relationshipPropertieRepo->find($relationshipPropertie->id);
        $this->assertModelData($fakerelationshipPropertie, $dbrelationshipPropertie->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleterelationshipPropertie()
    {
        $relationshipPropertie = $this->makerelationshipPropertie();
        $resp = $this->relationshipPropertieRepo->delete($relationshipPropertie->id);
        $this->assertTrue($resp);
        $this->assertNull(relationshipPropertie::find($relationshipPropertie->id), 'relationshipPropertie should not exist in DB');
    }
}
