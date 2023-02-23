<?php

use App\Models\inmumovto;
use App\Repositories\inmumovtoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class inmumovtoRepositoryTest extends TestCase
{
    use MakeinmumovtoTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var inmumovtoRepository
     */
    protected $inmumovtoRepo;

    public function setUp()
    {
        parent::setUp();
        $this->inmumovtoRepo = App::make(inmumovtoRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateinmumovto()
    {
        $inmumovto = $this->fakeinmumovtoData();
        $createdinmumovto = $this->inmumovtoRepo->create($inmumovto);
        $createdinmumovto = $createdinmumovto->toArray();
        $this->assertArrayHasKey('id', $createdinmumovto);
        $this->assertNotNull($createdinmumovto['id'], 'Created inmumovto must have id specified');
        $this->assertNotNull(inmumovto::find($createdinmumovto['id']), 'inmumovto with given id must be in DB');
        $this->assertModelData($inmumovto, $createdinmumovto);
    }

    /**
     * @test read
     */
    public function testReadinmumovto()
    {
        $inmumovto = $this->makeinmumovto();
        $dbinmumovto = $this->inmumovtoRepo->find($inmumovto->id);
        $dbinmumovto = $dbinmumovto->toArray();
        $this->assertModelData($inmumovto->toArray(), $dbinmumovto);
    }

    /**
     * @test update
     */
    public function testUpdateinmumovto()
    {
        $inmumovto = $this->makeinmumovto();
        $fakeinmumovto = $this->fakeinmumovtoData();
        $updatedinmumovto = $this->inmumovtoRepo->update($fakeinmumovto, $inmumovto->id);
        $this->assertModelData($fakeinmumovto, $updatedinmumovto->toArray());
        $dbinmumovto = $this->inmumovtoRepo->find($inmumovto->id);
        $this->assertModelData($fakeinmumovto, $dbinmumovto->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteinmumovto()
    {
        $inmumovto = $this->makeinmumovto();
        $resp = $this->inmumovtoRepo->delete($inmumovto->id);
        $this->assertTrue($resp);
        $this->assertNull(inmumovto::find($inmumovto->id), 'inmumovto should not exist in DB');
    }
}
