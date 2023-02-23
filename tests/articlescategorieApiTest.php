<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class articlescategorieApiTest extends TestCase
{
    use MakearticlescategorieTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatearticlescategorie()
    {
        $articlescategorie = $this->fakearticlescategorieData();
        $this->json('POST', '/api/v1/articlescategories', $articlescategorie);

        $this->assertApiResponse($articlescategorie);
    }

    /**
     * @test
     */
    public function testReadarticlescategorie()
    {
        $articlescategorie = $this->makearticlescategorie();
        $this->json('GET', '/api/v1/articlescategories/'.$articlescategorie->id);

        $this->assertApiResponse($articlescategorie->toArray());
    }

    /**
     * @test
     */
    public function testUpdatearticlescategorie()
    {
        $articlescategorie = $this->makearticlescategorie();
        $editedarticlescategorie = $this->fakearticlescategorieData();

        $this->json('PUT', '/api/v1/articlescategories/'.$articlescategorie->id, $editedarticlescategorie);

        $this->assertApiResponse($editedarticlescategorie);
    }

    /**
     * @test
     */
    public function testDeletearticlescategorie()
    {
        $articlescategorie = $this->makearticlescategorie();
        $this->json('DELETE', '/api/v1/articlescategories/'.$articlescategorie->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/articlescategories/'.$articlescategorie->id);

        $this->assertResponseStatus(404);
    }
}
