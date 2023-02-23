<?php

use Faker\Factory as Faker;
use App\Models\movtohead;
use App\Repositories\movtoheadRepository;

trait MakemovtoheadTrait
{
    /**
     * Create fake instance of movtohead and save it in database
     *
     * @param array $movtoheadFields
     * @return movtohead
     */
    public function makemovtohead($movtoheadFields = [])
    {
        /** @var movtoheadRepository $movtoheadRepo */
        $movtoheadRepo = App::make(movtoheadRepository::class);
        $theme = $this->fakemovtoheadData($movtoheadFields);
        return $movtoheadRepo->create($theme);
    }

    /**
     * Get fake instance of movtohead
     *
     * @param array $movtoheadFields
     * @return movtohead
     */
    public function fakemovtohead($movtoheadFields = [])
    {
        return new movtohead($this->fakemovtoheadData($movtoheadFields));
    }

    /**
     * Get fake data of movtohead
     *
     * @param array $postFields
     * @return array
     */
    public function fakemovtoheadData($movtoheadFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'inmueble_id' => $fake->randomDigitNotNull,
            'propertyarea_id' => $fake->randomDigitNotNull,
            'provider_id' => $fake->randomDigitNotNull,
            'movtype' => $fake->word,
            'fechafactura' => $fake->word,
            'folio' => $fake->word,
            'doc_link' => $fake->word,
            'stotal' => $fake->word,
            'iva' => $fake->word,
            'gtotal' => $fake->word,
            'status' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $movtoheadFields);
    }
}
