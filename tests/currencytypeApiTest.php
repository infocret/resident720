<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class currencytypeApiTest extends TestCase
{
    use MakecurrencytypeTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatecurrencytype()
    {
        $currencytype = $this->fakecurrencytypeData();
        $this->json('POST', '/api/v1/currencytypes', $currencytype);

        $this->assertApiResponse($currencytype);
    }

    /**
     * @test
     */
    public function testReadcurrencytype()
    {
        $currencytype = $this->makecurrencytype();
        $this->json('GET', '/api/v1/currencytypes/'.$currencytype->id);

        $this->assertApiResponse($currencytype->toArray());
    }

    /**
     * @test
     */
    public function testUpdatecurrencytype()
    {
        $currencytype = $this->makecurrencytype();
        $editedcurrencytype = $this->fakecurrencytypeData();

        $this->json('PUT', '/api/v1/currencytypes/'.$currencytype->id, $editedcurrencytype);

        $this->assertApiResponse($editedcurrencytype);
    }

    /**
     * @test
     */
    public function testDeletecurrencytype()
    {
        $currencytype = $this->makecurrencytype();
        $this->json('DELETE', '/api/v1/currencytypes/'.$currencytype->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/currencytypes/'.$currencytype->id);

        $this->assertResponseStatus(404);
    }
}
