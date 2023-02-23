<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class articleApiTest extends TestCase
{
    use MakearticleTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatearticle()
    {
        $article = $this->fakearticleData();
        $this->json('POST', '/api/v1/articles', $article);

        $this->assertApiResponse($article);
    }

    /**
     * @test
     */
    public function testReadarticle()
    {
        $article = $this->makearticle();
        $this->json('GET', '/api/v1/articles/'.$article->id);

        $this->assertApiResponse($article->toArray());
    }

    /**
     * @test
     */
    public function testUpdatearticle()
    {
        $article = $this->makearticle();
        $editedarticle = $this->fakearticleData();

        $this->json('PUT', '/api/v1/articles/'.$article->id, $editedarticle);

        $this->assertApiResponse($editedarticle);
    }

    /**
     * @test
     */
    public function testDeletearticle()
    {
        $article = $this->makearticle();
        $this->json('DELETE', '/api/v1/articles/'.$article->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/articles/'.$article->id);

        $this->assertResponseStatus(404);
    }
}
