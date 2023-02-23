<?php

use App\Models\currencytype;
use App\Repositories\currencytypeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class currencytypeRepositoryTest extends TestCase
{
    use MakecurrencytypeTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var currencytypeRepository
     */
    protected $currencytypeRepo;

    public function setUp()
    {
        parent::setUp();
        $this->currencytypeRepo = App::make(currencytypeRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatecurrencytype()
    {
        $currencytype = $this->fakecurrencytypeData();
        $createdcurrencytype = $this->currencytypeRepo->create($currencytype);
        $createdcurrencytype = $createdcurrencytype->toArray();
        $this->assertArrayHasKey('id', $createdcurrencytype);
        $this->assertNotNull($createdcurrencytype['id'], 'Created currencytype must have id specified');
        $this->assertNotNull(currencytype::find($createdcurrencytype['id']), 'currencytype with given id must be in DB');
        $this->assertModelData($currencytype, $createdcurrencytype);
    }

    /**
     * @test read
     */
    public function testReadcurrencytype()
    {
        $currencytype = $this->makecurrencytype();
        $dbcurrencytype = $this->currencytypeRepo->find($currencytype->id);
        $dbcurrencytype = $dbcurrencytype->toArray();
        $this->assertModelData($currencytype->toArray(), $dbcurrencytype);
    }

    /**
     * @test update
     */
    public function testUpdatecurrencytype()
    {
        $currencytype = $this->makecurrencytype();
        $fakecurrencytype = $this->fakecurrencytypeData();
        $updatedcurrencytype = $this->currencytypeRepo->update($fakecurrencytype, $currencytype->id);
        $this->assertModelData($fakecurrencytype, $updatedcurrencytype->toArray());
        $dbcurrencytype = $this->currencytypeRepo->find($currencytype->id);
        $this->assertModelData($fakecurrencytype, $dbcurrencytype->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletecurrencytype()
    {
        $currencytype = $this->makecurrencytype();
        $resp = $this->currencytypeRepo->delete($currencytype->id);
        $this->assertTrue($resp);
        $this->assertNull(currencytype::find($currencytype->id), 'currencytype should not exist in DB');
    }
}
