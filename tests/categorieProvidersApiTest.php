<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class categorieProvidersApiTest extends TestCase
{
    use MakecategorieProvidersTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatecategorieProviders()
    {
        $categorieProviders = $this->fakecategorieProvidersData();
        $this->json('POST', '/api/v1/categorieProviders', $categorieProviders);

        $this->assertApiResponse($categorieProviders);
    }

    /**
     * @test
     */
    public function testReadcategorieProviders()
    {
        $categorieProviders = $this->makecategorieProviders();
        $this->json('GET', '/api/v1/categorieProviders/'.$categorieProviders->id);

        $this->assertApiResponse($categorieProviders->toArray());
    }

    /**
     * @test
     */
    public function testUpdatecategorieProviders()
    {
        $categorieProviders = $this->makecategorieProviders();
        $editedcategorieProviders = $this->fakecategorieProvidersData();

        $this->json('PUT', '/api/v1/categorieProviders/'.$categorieProviders->id, $editedcategorieProviders);

        $this->assertApiResponse($editedcategorieProviders);
    }

    /**
     * @test
     */
    public function testDeletecategorieProviders()
    {
        $categorieProviders = $this->makecategorieProviders();
        $this->json('DELETE', '/api/v1/categorieProviders/'.$categorieProviders->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/categorieProviders/'.$categorieProviders->id);

        $this->assertResponseStatus(404);
    }
}
