<?php

use App\Models\banksquare;
use App\Repositories\banksquareRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class banksquareRepositoryTest extends TestCase
{
    use MakebanksquareTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var banksquareRepository
     */
    protected $banksquareRepo;

    public function setUp()
    {
        parent::setUp();
        $this->banksquareRepo = App::make(banksquareRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatebanksquare()
    {
        $banksquare = $this->fakebanksquareData();
        $createdbanksquare = $this->banksquareRepo->create($banksquare);
        $createdbanksquare = $createdbanksquare->toArray();
        $this->assertArrayHasKey('id', $createdbanksquare);
        $this->assertNotNull($createdbanksquare['id'], 'Created banksquare must have id specified');
        $this->assertNotNull(banksquare::find($createdbanksquare['id']), 'banksquare with given id must be in DB');
        $this->assertModelData($banksquare, $createdbanksquare);
    }

    /**
     * @test read
     */
    public function testReadbanksquare()
    {
        $banksquare = $this->makebanksquare();
        $dbbanksquare = $this->banksquareRepo->find($banksquare->id);
        $dbbanksquare = $dbbanksquare->toArray();
        $this->assertModelData($banksquare->toArray(), $dbbanksquare);
    }

    /**
     * @test update
     */
    public function testUpdatebanksquare()
    {
        $banksquare = $this->makebanksquare();
        $fakebanksquare = $this->fakebanksquareData();
        $updatedbanksquare = $this->banksquareRepo->update($fakebanksquare, $banksquare->id);
        $this->assertModelData($fakebanksquare, $updatedbanksquare->toArray());
        $dbbanksquare = $this->banksquareRepo->find($banksquare->id);
        $this->assertModelData($fakebanksquare, $dbbanksquare->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletebanksquare()
    {
        $banksquare = $this->makebanksquare();
        $resp = $this->banksquareRepo->delete($banksquare->id);
        $this->assertTrue($resp);
        $this->assertNull(banksquare::find($banksquare->id), 'banksquare should not exist in DB');
    }
}
