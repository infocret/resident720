<?php

use Faker\Factory as Faker;
use App\Models\gasconsumption;
use App\Repositories\gasconsumptionRepository;

trait MakegasconsumptionTrait
{
    /**
     * Create fake instance of gasconsumption and save it in database
     *
     * @param array $gasconsumptionFields
     * @return gasconsumption
     */
    public function makegasconsumption($gasconsumptionFields = [])
    {
        /** @var gasconsumptionRepository $gasconsumptionRepo */
        $gasconsumptionRepo = App::make(gasconsumptionRepository::class);
        $theme = $this->fakegasconsumptionData($gasconsumptionFields);
        return $gasconsumptionRepo->create($theme);
    }

    /**
     * Get fake instance of gasconsumption
     *
     * @param array $gasconsumptionFields
     * @return gasconsumption
     */
    public function fakegasconsumption($gasconsumptionFields = [])
    {
        return new gasconsumption($this->fakegasconsumptionData($gasconsumptionFields));
    }

    /**
     * Get fake data of gasconsumption
     *
     * @param array $postFields
     * @return array
     */
    public function fakegasconsumptionData($gasconsumptionFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'inmueble_id' => $fake->randomDigitNotNull,
            'reading_date' => $fake->word,
            'last_reading' => $fake->word,
            'current_reading' => $fake->word,
            'quantity' => $fake->word,
            'gas_price' => $fake->word,
            'amount' => $fake->word,
            'application_date' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word,
            'deleted_at' => $fake->word
        ], $gasconsumptionFields);
    }
}
