<?php

use Faker\Factory as Faker;
use App\Models\procedmovto;
use App\Repositories\procedmovtoRepository;

trait MakeprocedmovtoTrait
{
    /**
     * Create fake instance of procedmovto and save it in database
     *
     * @param array $procedmovtoFields
     * @return procedmovto
     */
    public function makeprocedmovto($procedmovtoFields = [])
    {
        /** @var procedmovtoRepository $procedmovtoRepo */
        $procedmovtoRepo = App::make(procedmovtoRepository::class);
        $theme = $this->fakeprocedmovtoData($procedmovtoFields);
        return $procedmovtoRepo->create($theme);
    }

    /**
     * Get fake instance of procedmovto
     *
     * @param array $procedmovtoFields
     * @return procedmovto
     */
    public function fakeprocedmovto($procedmovtoFields = [])
    {
        return new procedmovto($this->fakeprocedmovtoData($procedmovtoFields));
    }

    /**
     * Get fake data of procedmovto
     *
     * @param array $postFields
     * @return array
     */
    public function fakeprocedmovtoData($procedmovtoFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'inmueble_id' => $fake->randomDigitNotNull,
            'conceptservice_id' => $fake->randomDigitNotNull,
            'catmovto_id' => $fake->randomDigitNotNull,
            'concept_cve' => $fake->randomDigitNotNull,
            'movto_cve' => $fake->randomDigitNotNull,
            'procedimiento' => $fake->word,
            'parametros' => $fake->word,
            'execauto' => $fake->randomDigitNotNull,
            'nombre' => $fake->word,
            'desc' => $fake->word,
            'observ' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $procedmovtoFields);
    }
}
