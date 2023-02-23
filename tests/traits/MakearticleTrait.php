<?php

use Faker\Factory as Faker;
use App\Models\article;
use App\Repositories\articleRepository;

trait MakearticleTrait
{
    /**
     * Create fake instance of article and save it in database
     *
     * @param array $articleFields
     * @return article
     */
    public function makearticle($articleFields = [])
    {
        /** @var articleRepository $articleRepo */
        $articleRepo = App::make(articleRepository::class);
        $theme = $this->fakearticleData($articleFields);
        return $articleRepo->create($theme);
    }

    /**
     * Get fake instance of article
     *
     * @param array $articleFields
     * @return article
     */
    public function fakearticle($articleFields = [])
    {
        return new article($this->fakearticleData($articleFields));
    }

    /**
     * Get fake data of article
     *
     * @param array $postFields
     * @return array
     */
    public function fakearticleData($articleFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'articlescategorie_id' => $fake->randomDigitNotNull,
            'cve' => $fake->word,
            'shortname' => $fake->word,
            'name' => $fake->word,
            'description' => $fake->word,
            'measurement' => $fake->word,
            'barcode' => $fake->word,
            'observations' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $articleFields);
    }
}
