<?php

use Faker\Factory as Faker;
use App\Models\headmov;
use App\Repositories\headmovRepository;

trait MakeheadmovTrait
{
    /**
     * Create fake instance of headmov and save it in database
     *
     * @param array $headmovFields
     * @return headmov
     */
    public function makeheadmov($headmovFields = [])
    {
        /** @var headmovRepository $headmovRepo */
        $headmovRepo = App::make(headmovRepository::class);
        $theme = $this->fakeheadmovData($headmovFields);
        return $headmovRepo->create($theme);
    }

    /**
     * Get fake instance of headmov
     *
     * @param array $headmovFields
     * @return headmov
     */
    public function fakeheadmov($headmovFields = [])
    {
        return new headmov($this->fakeheadmovData($headmovFields));
    }

    /**
     * Get fake data of headmov
     *
     * @param array $postFields
     * @return array
     */
    public function fakeheadmovData($headmovFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'inmueble_id' => $fake->randomDigitNotNull,
            'propertyarea_id' => $fake->randomDigitNotNull,
            'provider_id' => $fake->randomDigitNotNull,
            'fecharegistro' => $fake->word,
            'fechafactura' => $fake->word,
            'folio' => $fake->word,
            'doc' => $fake->word,
            'stotal' => $fake->word,
            'iva' => $fake->word,
            'gtotal' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $headmovFields);
    }
}
