<?php

use App\Models\articlescategorie;
use App\Repositories\articlescategorieRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class articlescategorieRepositoryTest extends TestCase
{
    use MakearticlescategorieTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var articlescategorieRepository
     */
    protected $articlescategorieRepo;

    public function setUp()
    {
        parent::setUp();
        $this->articlescategorieRepo = App::make(articlescategorieRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatearticlescategorie()
    {
        $articlescategorie = $this->fakearticlescategorieData();
        $createdarticlescategorie = $this->articlescategorieRepo->create($articlescategorie);
        $createdarticlescategorie = $createdarticlescategorie->toArray();
        $this->assertArrayHasKey('id', $createdarticlescategorie);
        $this->assertNotNull($createdarticlescategorie['id'], 'Created articlescategorie must have id specified');
        $this->assertNotNull(articlescategorie::find($createdarticlescategorie['id']), 'articlescategorie with given id must be in DB');
        $this->assertModelData($articlescategorie, $createdarticlescategorie);
    }

    /**
     * @test read
     */
    public function testReadarticlescategorie()
    {
        $articlescategorie = $this->makearticlescategorie();
        $dbarticlescategorie = $this->articlescategorieRepo->find($articlescategorie->id);
        $dbarticlescategorie = $dbarticlescategorie->toArray();
        $this->assertModelData($articlescategorie->toArray(), $dbarticlescategorie);
    }

    /**
     * @test update
     */
    public function testUpdatearticlescategorie()
    {
        $articlescategorie = $this->makearticlescategorie();
        $fakearticlescategorie = $this->fakearticlescategorieData();
        $updatedarticlescategorie = $this->articlescategorieRepo->update($fakearticlescategorie, $articlescategorie->id);
        $this->assertModelData($fakearticlescategorie, $updatedarticlescategorie->toArray());
        $dbarticlescategorie = $this->articlescategorieRepo->find($articlescategorie->id);
        $this->assertModelData($fakearticlescategorie, $dbarticlescategorie->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletearticlescategorie()
    {
        $articlescategorie = $this->makearticlescategorie();
        $resp = $this->articlescategorieRepo->delete($articlescategorie->id);
        $this->assertTrue($resp);
        $this->assertNull(articlescategorie::find($articlescategorie->id), 'articlescategorie should not exist in DB');
    }
}
