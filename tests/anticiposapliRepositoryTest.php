<?php namespace Tests\Repositories;

use App\Models\anticiposapli;
use App\Repositories\anticiposapliRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class anticiposapliRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var anticiposapliRepository
     */
    protected $anticiposapliRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->anticiposapliRepo = \App::make(anticiposapliRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_anticiposapli()
    {
        $anticiposapli = factory(anticiposapli::class)->make()->toArray();

        $createdanticiposapli = $this->anticiposapliRepo->create($anticiposapli);

        $createdanticiposapli = $createdanticiposapli->toArray();
        $this->assertArrayHasKey('id', $createdanticiposapli);
        $this->assertNotNull($createdanticiposapli['id'], 'Created anticiposapli must have id specified');
        $this->assertNotNull(anticiposapli::find($createdanticiposapli['id']), 'anticiposapli with given id must be in DB');
        $this->assertModelData($anticiposapli, $createdanticiposapli);
    }

    /**
     * @test read
     */
    public function test_read_anticiposapli()
    {
        $anticiposapli = factory(anticiposapli::class)->create();

        $dbanticiposapli = $this->anticiposapliRepo->find($anticiposapli->id);

        $dbanticiposapli = $dbanticiposapli->toArray();
        $this->assertModelData($anticiposapli->toArray(), $dbanticiposapli);
    }

    /**
     * @test update
     */
    public function test_update_anticiposapli()
    {
        $anticiposapli = factory(anticiposapli::class)->create();
        $fakeanticiposapli = factory(anticiposapli::class)->make()->toArray();

        $updatedanticiposapli = $this->anticiposapliRepo->update($fakeanticiposapli, $anticiposapli->id);

        $this->assertModelData($fakeanticiposapli, $updatedanticiposapli->toArray());
        $dbanticiposapli = $this->anticiposapliRepo->find($anticiposapli->id);
        $this->assertModelData($fakeanticiposapli, $dbanticiposapli->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_anticiposapli()
    {
        $anticiposapli = factory(anticiposapli::class)->create();

        $resp = $this->anticiposapliRepo->delete($anticiposapli->id);

        $this->assertTrue($resp);
        $this->assertNull(anticiposapli::find($anticiposapli->id), 'anticiposapli should not exist in DB');
    }
}
