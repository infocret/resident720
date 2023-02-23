<?php

use App\Models\personaccount;
use App\Repositories\personaccountRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class personaccountRepositoryTest extends TestCase
{
    use MakepersonaccountTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var personaccountRepository
     */
    protected $personaccountRepo;

    public function setUp()
    {
        parent::setUp();
        $this->personaccountRepo = App::make(personaccountRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatepersonaccount()
    {
        $personaccount = $this->fakepersonaccountData();
        $createdpersonaccount = $this->personaccountRepo->create($personaccount);
        $createdpersonaccount = $createdpersonaccount->toArray();
        $this->assertArrayHasKey('id', $createdpersonaccount);
        $this->assertNotNull($createdpersonaccount['id'], 'Created personaccount must have id specified');
        $this->assertNotNull(personaccount::find($createdpersonaccount['id']), 'personaccount with given id must be in DB');
        $this->assertModelData($personaccount, $createdpersonaccount);
    }

    /**
     * @test read
     */
    public function testReadpersonaccount()
    {
        $personaccount = $this->makepersonaccount();
        $dbpersonaccount = $this->personaccountRepo->find($personaccount->id);
        $dbpersonaccount = $dbpersonaccount->toArray();
        $this->assertModelData($personaccount->toArray(), $dbpersonaccount);
    }

    /**
     * @test update
     */
    public function testUpdatepersonaccount()
    {
        $personaccount = $this->makepersonaccount();
        $fakepersonaccount = $this->fakepersonaccountData();
        $updatedpersonaccount = $this->personaccountRepo->update($fakepersonaccount, $personaccount->id);
        $this->assertModelData($fakepersonaccount, $updatedpersonaccount->toArray());
        $dbpersonaccount = $this->personaccountRepo->find($personaccount->id);
        $this->assertModelData($fakepersonaccount, $dbpersonaccount->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletepersonaccount()
    {
        $personaccount = $this->makepersonaccount();
        $resp = $this->personaccountRepo->delete($personaccount->id);
        $this->assertTrue($resp);
        $this->assertNull(personaccount::find($personaccount->id), 'personaccount should not exist in DB');
    }
}
