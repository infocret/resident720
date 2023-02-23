<?php

use Faker\Factory as Faker;
use App\Models\detailmov;
use App\Repositories\detailmovRepository;

trait MakedetailmovTrait
{
    /**
     * Create fake instance of detailmov and save it in database
     *
     * @param array $detailmovFields
     * @return detailmov
     */
    public function makedetailmov($detailmovFields = [])
    {
        /** @var detailmovRepository $detailmovRepo */
        $detailmovRepo = App::make(detailmovRepository::class);
        $theme = $this->fakedetailmovData($detailmovFields);
        return $detailmovRepo->create($theme);
    }

    /**
     * Get fake instance of detailmov
     *
     * @param array $detailmovFields
     * @return detailmov
     */
    public function fakedetailmov($detailmovFields = [])
    {
        return new detailmov($this->fakedetailmovData($detailmovFields));
    }

    /**
     * Get fake data of detailmov
     *
     * @param array $postFields
     * @return array
     */
    public function fakedetailmovData($detailmovFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'headmov_id' => $fake->randomDigitNotNull,
            'movimientoTipo_id' => $fake->randomDigitNotNull,
            'cantidad' => $fake->word,
            'unidad' => $fake->word,
            'descripcion' => $fake->word,
            'preciounit' => $fake->word,
            'subtot' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $detailmovFields);
    }
}
