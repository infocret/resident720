<?php

use App\Models\statusticketimg;
use App\Repositories\statusticketimgRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class statusticketimgRepositoryTest extends TestCase
{
    use MakestatusticketimgTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var statusticketimgRepository
     */
    protected $statusticketimgRepo;

    public function setUp()
    {
        parent::setUp();
        $this->statusticketimgRepo = App::make(statusticketimgRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatestatusticketimg()
    {
        $statusticketimg = $this->fakestatusticketimgData();
        $createdstatusticketimg = $this->statusticketimgRepo->create($statusticketimg);
        $createdstatusticketimg = $createdstatusticketimg->toArray();
        $this->assertArrayHasKey('id', $createdstatusticketimg);
        $this->assertNotNull($createdstatusticketimg['id'], 'Created statusticketimg must have id specified');
        $this->assertNotNull(statusticketimg::find($createdstatusticketimg['id']), 'statusticketimg with given id must be in DB');
        $this->assertModelData($statusticketimg, $createdstatusticketimg);
    }

    /**
     * @test read
     */
    public function testReadstatusticketimg()
    {
        $statusticketimg = $this->makestatusticketimg();
        $dbstatusticketimg = $this->statusticketimgRepo->find($statusticketimg->id);
        $dbstatusticketimg = $dbstatusticketimg->toArray();
        $this->assertModelData($statusticketimg->toArray(), $dbstatusticketimg);
    }

    /**
     * @test update
     */
    public function testUpdatestatusticketimg()
    {
        $statusticketimg = $this->makestatusticketimg();
        $fakestatusticketimg = $this->fakestatusticketimgData();
        $updatedstatusticketimg = $this->statusticketimgRepo->update($fakestatusticketimg, $statusticketimg->id);
        $this->assertModelData($fakestatusticketimg, $updatedstatusticketimg->toArray());
        $dbstatusticketimg = $this->statusticketimgRepo->find($statusticketimg->id);
        $this->assertModelData($fakestatusticketimg, $dbstatusticketimg->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletestatusticketimg()
    {
        $statusticketimg = $this->makestatusticketimg();
        $resp = $this->statusticketimgRepo->delete($statusticketimg->id);
        $this->assertTrue($resp);
        $this->assertNull(statusticketimg::find($statusticketimg->id), 'statusticketimg should not exist in DB');
    }
}
