<?php

use Faker\Factory as Faker;
use App\Models\unidadmovto;
use App\Repositories\unidadmovtoRepository;

trait MakeunidadmovtoTrait
{
    /**
     * Create fake instance of unidadmovto and save it in database
     *
     * @param array $unidadmovtoFields
     * @return unidadmovto
     */
    public function makeunidadmovto($unidadmovtoFields = [])
    {
        /** @var unidadmovtoRepository $unidadmovtoRepo */
        $unidadmovtoRepo = App::make(unidadmovtoRepository::class);
        $theme = $this->fakeunidadmovtoData($unidadmovtoFields);
        return $unidadmovtoRepo->create($theme);
    }

    /**
     * Get fake instance of unidadmovto
     *
     * @param array $unidadmovtoFields
     * @return unidadmovto
     */
    public function fakeunidadmovto($unidadmovtoFields = [])
    {
        return new unidadmovto($this->fakeunidadmovtoData($unidadmovtoFields));
    }

    /**
     * Get fake data of unidadmovto
     *
     * @param array $postFields
     * @return array
     */
    public function fakeunidadmovtoData($unidadmovtoFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'inmu_id' => $fake->randomDigitNotNull,
            'movto_id' => $fake->randomDigitNotNull,
            'periodap' => $fake->word,
            'validity' => $fake->word,
            'amount' => $fake->word,
            'nextap' => $fake->word,
            'endvalidity' => $fake->word,
            'observ' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word,
            'deleted_at' => $fake->word
        ], $unidadmovtoFields);
    }
}
