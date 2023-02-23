<?php

use Faker\Factory as Faker;
use App\Models\measurunit;
use App\Repositories\measurunitRepository;

trait MakemeasurunitTrait
{
    /**
     * Create fake instance of measurunit and save it in database
     *
     * @param array $measurunitFields
     * @return measurunit
     */
    public function makemeasurunit($measurunitFields = [])
    {
        /** @var measurunitRepository $measurunitRepo */
        $measurunitRepo = App::make(measurunitRepository::class);
        $theme = $this->fakemeasurunitData($measurunitFields);
        return $measurunitRepo->create($theme);
    }

    /**
     * Get fake instance of measurunit
     *
     * @param array $measurunitFields
     * @return measurunit
     */
    public function fakemeasurunit($measurunitFields = [])
    {
        return new measurunit($this->fakemeasurunitData($measurunitFields));
    }

    /**
     * Get fake data of measurunit
     *
     * @param array $postFields
     * @return array
     */
    public function fakemeasurunitData($measurunitFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'cve' => $fake->word,
            'nombre' => $fake->word,
            'tipo' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $measurunitFields);
    }
}
