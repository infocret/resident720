<?php

use App\Models\perioddate;
use App\Repositories\perioddateRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class perioddateRepositoryTest extends TestCase
{
    use MakeperioddateTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var perioddateRepository
     */
    protected $perioddateRepo;

    public function setUp()
    {
        parent::setUp();
        $this->perioddateRepo = App::make(perioddateRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateperioddate()
    {
        $perioddate = $this->fakeperioddateData();
        $createdperioddate = $this->perioddateRepo->create($perioddate);
        $createdperioddate = $createdperioddate->toArray();
        $this->assertArrayHasKey('id', $createdperioddate);
        $this->assertNotNull($createdperioddate['id'], 'Created perioddate must have id specified');
        $this->assertNotNull(perioddate::find($createdperioddate['id']), 'perioddate with given id must be in DB');
        $this->assertModelData($perioddate, $createdperioddate);
    }

    /**
     * @test read
     */
    public function testReadperioddate()
    {
        $perioddate = $this->makeperioddate();
        $dbperioddate = $this->perioddateRepo->find($perioddate->id);
        $dbperioddate = $dbperioddate->toArray();
        $this->assertModelData($perioddate->toArray(), $dbperioddate);
    }

    /**
     * @test update
     */
    public function testUpdateperioddate()
    {
        $perioddate = $this->makeperioddate();
        $fakeperioddate = $this->fakeperioddateData();
        $updatedperioddate = $this->perioddateRepo->update($fakeperioddate, $perioddate->id);
        $this->assertModelData($fakeperioddate, $updatedperioddate->toArray());
        $dbperioddate = $this->perioddateRepo->find($perioddate->id);
        $this->assertModelData($fakeperioddate, $dbperioddate->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteperioddate()
    {
        $perioddate = $this->makeperioddate();
        $resp = $this->perioddateRepo->delete($perioddate->id);
        $this->assertTrue($resp);
        $this->assertNull(perioddate::find($perioddate->id), 'perioddate should not exist in DB');
    }
}
