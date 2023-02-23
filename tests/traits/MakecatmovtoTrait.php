<?php

use Faker\Factory as Faker;
use App\Models\catmovto;
use App\Repositories\catmovtoRepository;

trait MakecatmovtoTrait
{
    /**
     * Create fake instance of catmovto and save it in database
     *
     * @param array $catmovtoFields
     * @return catmovto
     */
    public function makecatmovto($catmovtoFields = [])
    {
        /** @var catmovtoRepository $catmovtoRepo */
        $catmovtoRepo = App::make(catmovtoRepository::class);
        $theme = $this->fakecatmovtoData($catmovtoFields);
        return $catmovtoRepo->create($theme);
    }

    /**
     * Get fake instance of catmovto
     *
     * @param array $catmovtoFields
     * @return catmovto
     */
    public function fakecatmovto($catmovtoFields = [])
    {
        return new catmovto($this->fakecatmovtoData($catmovtoFields));
    }

    /**
     * Get fake data of catmovto
     *
     * @param array $postFields
     * @return array
     */
    public function fakecatmovtoData($catmovtoFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'conceptserv_id' => $fake->randomDigitNotNull,
            'cve' => $fake->randomDigitNotNull,
            'tipo' => $fake->word,
            'shortname' => $fake->word,
            'name' => $fake->word,
            'description' => $fake->word,
            'observ' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word,
            'deleted_at' => $fake->word
        ], $catmovtoFields);
    }
}
