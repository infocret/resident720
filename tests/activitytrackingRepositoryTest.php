<?php

use App\Models\activitytracking;
use App\Repositories\activitytrackingRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class activitytrackingRepositoryTest extends TestCase
{
    use MakeactivitytrackingTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var activitytrackingRepository
     */
    protected $activitytrackingRepo;

    public function setUp()
    {
        parent::setUp();
        $this->activitytrackingRepo = App::make(activitytrackingRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateactivitytracking()
    {
        $activitytracking = $this->fakeactivitytrackingData();
        $createdactivitytracking = $this->activitytrackingRepo->create($activitytracking);
        $createdactivitytracking = $createdactivitytracking->toArray();
        $this->assertArrayHasKey('id', $createdactivitytracking);
        $this->assertNotNull($createdactivitytracking['id'], 'Created activitytracking must have id specified');
        $this->assertNotNull(activitytracking::find($createdactivitytracking['id']), 'activitytracking with given id must be in DB');
        $this->assertModelData($activitytracking, $createdactivitytracking);
    }

    /**
     * @test read
     */
    public function testReadactivitytracking()
    {
        $activitytracking = $this->makeactivitytracking();
        $dbactivitytracking = $this->activitytrackingRepo->find($activitytracking->id);
        $dbactivitytracking = $dbactivitytracking->toArray();
        $this->assertModelData($activitytracking->toArray(), $dbactivitytracking);
    }

    /**
     * @test update
     */
    public function testUpdateactivitytracking()
    {
        $activitytracking = $this->makeactivitytracking();
        $fakeactivitytracking = $this->fakeactivitytrackingData();
        $updatedactivitytracking = $this->activitytrackingRepo->update($fakeactivitytracking, $activitytracking->id);
        $this->assertModelData($fakeactivitytracking, $updatedactivitytracking->toArray());
        $dbactivitytracking = $this->activitytrackingRepo->find($activitytracking->id);
        $this->assertModelData($fakeactivitytracking, $dbactivitytracking->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteactivitytracking()
    {
        $activitytracking = $this->makeactivitytracking();
        $resp = $this->activitytrackingRepo->delete($activitytracking->id);
        $this->assertTrue($resp);
        $this->assertNull(activitytracking::find($activitytracking->id), 'activitytracking should not exist in DB');
    }
}
