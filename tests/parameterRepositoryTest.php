<?php

use App\Models\parameter;
use App\Repositories\parameterRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class parameterRepositoryTest extends TestCase
{
    use MakeparameterTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var parameterRepository
     */
    protected $parameterRepo;

    public function setUp()
    {
        parent::setUp();
        $this->parameterRepo = App::make(parameterRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateparameter()
    {
        $parameter = $this->fakeparameterData();
        $createdparameter = $this->parameterRepo->create($parameter);
        $createdparameter = $createdparameter->toArray();
        $this->assertArrayHasKey('id', $createdparameter);
        $this->assertNotNull($createdparameter['id'], 'Created parameter must have id specified');
        $this->assertNotNull(parameter::find($createdparameter['id']), 'parameter with given id must be in DB');
        $this->assertModelData($parameter, $createdparameter);
    }

    /**
     * @test read
     */
    public function testReadparameter()
    {
        $parameter = $this->makeparameter();
        $dbparameter = $this->parameterRepo->find($parameter->id);
        $dbparameter = $dbparameter->toArray();
        $this->assertModelData($parameter->toArray(), $dbparameter);
    }

    /**
     * @test update
     */
    public function testUpdateparameter()
    {
        $parameter = $this->makeparameter();
        $fakeparameter = $this->fakeparameterData();
        $updatedparameter = $this->parameterRepo->update($fakeparameter, $parameter->id);
        $this->assertModelData($fakeparameter, $updatedparameter->toArray());
        $dbparameter = $this->parameterRepo->find($parameter->id);
        $this->assertModelData($fakeparameter, $dbparameter->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteparameter()
    {
        $parameter = $this->makeparameter();
        $resp = $this->parameterRepo->delete($parameter->id);
        $this->assertTrue($resp);
        $this->assertNull(parameter::find($parameter->id), 'parameter should not exist in DB');
    }
}
