<?php namespace Tests\Repositories;

use App\Models\anticipo;
use App\Repositories\anticipoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class anticipoRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var anticipoRepository
     */
    protected $anticipoRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->anticipoRepo = \App::make(anticipoRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_anticipo()
    {
        $anticipo = factory(anticipo::class)->make()->toArray();

        $createdanticipo = $this->anticipoRepo->create($anticipo);

        $createdanticipo = $createdanticipo->toArray();
        $this->assertArrayHasKey('id', $createdanticipo);
        $this->assertNotNull($createdanticipo['id'], 'Created anticipo must have id specified');
        $this->assertNotNull(anticipo::find($createdanticipo['id']), 'anticipo with given id must be in DB');
        $this->assertModelData($anticipo, $createdanticipo);
    }

    /**
     * @test read
     */
    public function test_read_anticipo()
    {
        $anticipo = factory(anticipo::class)->create();

        $dbanticipo = $this->anticipoRepo->find($anticipo->id);

        $dbanticipo = $dbanticipo->toArray();
        $this->assertModelData($anticipo->toArray(), $dbanticipo);
    }

    /**
     * @test update
     */
    public function test_update_anticipo()
    {
        $anticipo = factory(anticipo::class)->create();
        $fakeanticipo = factory(anticipo::class)->make()->toArray();

        $updatedanticipo = $this->anticipoRepo->update($fakeanticipo, $anticipo->id);

        $this->assertModelData($fakeanticipo, $updatedanticipo->toArray());
        $dbanticipo = $this->anticipoRepo->find($anticipo->id);
        $this->assertModelData($fakeanticipo, $dbanticipo->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_anticipo()
    {
        $anticipo = factory(anticipo::class)->create();

        $resp = $this->anticipoRepo->delete($anticipo->id);

        $this->assertTrue($resp);
        $this->assertNull(anticipo::find($anticipo->id), 'anticipo should not exist in DB');
    }
}
