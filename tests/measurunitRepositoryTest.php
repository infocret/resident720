<?php

use App\Models\measurunit;
use App\Repositories\measurunitRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class measurunitRepositoryTest extends TestCase
{
    use MakemeasurunitTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var measurunitRepository
     */
    protected $measurunitRepo;

    public function setUp()
    {
        parent::setUp();
        $this->measurunitRepo = App::make(measurunitRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatemeasurunit()
    {
        $measurunit = $this->fakemeasurunitData();
        $createdmeasurunit = $this->measurunitRepo->create($measurunit);
        $createdmeasurunit = $createdmeasurunit->toArray();
        $this->assertArrayHasKey('id', $createdmeasurunit);
        $this->assertNotNull($createdmeasurunit['id'], 'Created measurunit must have id specified');
        $this->assertNotNull(measurunit::find($createdmeasurunit['id']), 'measurunit with given id must be in DB');
        $this->assertModelData($measurunit, $createdmeasurunit);
    }

    /**
     * @test read
     */
    public function testReadmeasurunit()
    {
        $measurunit = $this->makemeasurunit();
        $dbmeasurunit = $this->measurunitRepo->find($measurunit->id);
        $dbmeasurunit = $dbmeasurunit->toArray();
        $this->assertModelData($measurunit->toArray(), $dbmeasurunit);
    }

    /**
     * @test update
     */
    public function testUpdatemeasurunit()
    {
        $measurunit = $this->makemeasurunit();
        $fakemeasurunit = $this->fakemeasurunitData();
        $updatedmeasurunit = $this->measurunitRepo->update($fakemeasurunit, $measurunit->id);
        $this->assertModelData($fakemeasurunit, $updatedmeasurunit->toArray());
        $dbmeasurunit = $this->measurunitRepo->find($measurunit->id);
        $this->assertModelData($fakemeasurunit, $dbmeasurunit->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletemeasurunit()
    {
        $measurunit = $this->makemeasurunit();
        $resp = $this->measurunitRepo->delete($measurunit->id);
        $this->assertTrue($resp);
        $this->assertNull(measurunit::find($measurunit->id), 'measurunit should not exist in DB');
    }
}
