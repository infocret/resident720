<?php

use App\Models\article;
use App\Repositories\articleRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class articleRepositoryTest extends TestCase
{
    use MakearticleTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var articleRepository
     */
    protected $articleRepo;

    public function setUp()
    {
        parent::setUp();
        $this->articleRepo = App::make(articleRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatearticle()
    {
        $article = $this->fakearticleData();
        $createdarticle = $this->articleRepo->create($article);
        $createdarticle = $createdarticle->toArray();
        $this->assertArrayHasKey('id', $createdarticle);
        $this->assertNotNull($createdarticle['id'], 'Created article must have id specified');
        $this->assertNotNull(article::find($createdarticle['id']), 'article with given id must be in DB');
        $this->assertModelData($article, $createdarticle);
    }

    /**
     * @test read
     */
    public function testReadarticle()
    {
        $article = $this->makearticle();
        $dbarticle = $this->articleRepo->find($article->id);
        $dbarticle = $dbarticle->toArray();
        $this->assertModelData($article->toArray(), $dbarticle);
    }

    /**
     * @test update
     */
    public function testUpdatearticle()
    {
        $article = $this->makearticle();
        $fakearticle = $this->fakearticleData();
        $updatedarticle = $this->articleRepo->update($fakearticle, $article->id);
        $this->assertModelData($fakearticle, $updatedarticle->toArray());
        $dbarticle = $this->articleRepo->find($article->id);
        $this->assertModelData($fakearticle, $dbarticle->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletearticle()
    {
        $article = $this->makearticle();
        $resp = $this->articleRepo->delete($article->id);
        $this->assertTrue($resp);
        $this->assertNull(article::find($article->id), 'article should not exist in DB');
    }
}
