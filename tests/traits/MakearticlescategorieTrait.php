<?php

use Faker\Factory as Faker;
use App\Models\articlescategorie;
use App\Repositories\articlescategorieRepository;

trait MakearticlescategorieTrait
{
    /**
     * Create fake instance of articlescategorie and save it in database
     *
     * @param array $articlescategorieFields
     * @return articlescategorie
     */
    public function makearticlescategorie($articlescategorieFields = [])
    {
        /** @var articlescategorieRepository $articlescategorieRepo */
        $articlescategorieRepo = App::make(articlescategorieRepository::class);
        $theme = $this->fakearticlescategorieData($articlescategorieFields);
        return $articlescategorieRepo->create($theme);
    }

    /**
     * Get fake instance of articlescategorie
     *
     * @param array $articlescategorieFields
     * @return articlescategorie
     */
    public function fakearticlescategorie($articlescategorieFields = [])
    {
        return new articlescategorie($this->fakearticlescategorieData($articlescategorieFields));
    }

    /**
     * Get fake data of articlescategorie
     *
     * @param array $postFields
     * @return array
     */
    public function fakearticlescategorieData($articlescategorieFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'cve' => $fake->word,
            'shortname' => $fake->word,
            'name' => $fake->word,
            'description' => $fake->word,
            'observations' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $articlescategorieFields);
    }
}
