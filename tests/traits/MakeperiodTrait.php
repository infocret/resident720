<?php

use Faker\Factory as Faker;
use App\Models\period;
use App\Repositories\periodRepository;

trait MakeperiodTrait
{
    /**
     * Create fake instance of period and save it in database
     *
     * @param array $periodFields
     * @return period
     */
    public function makeperiod($periodFields = [])
    {
        /** @var periodRepository $periodRepo */
        $periodRepo = App::make(periodRepository::class);
        $theme = $this->fakeperiodData($periodFields);
        return $periodRepo->create($theme);
    }

    /**
     * Get fake instance of period
     *
     * @param array $periodFields
     * @return period
     */
    public function fakeperiod($periodFields = [])
    {
        return new period($this->fakeperiodData($periodFields));
    }

    /**
     * Get fake data of period
     *
     * @param array $postFields
     * @return array
     */
    public function fakeperiodData($periodFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'cve' => $fake->word,
            'shortname' => $fake->word,
            'name' => $fake->word,
            'start_date' => $fake->word,
            'final_date' => $fake->word,
            'recurrence' => $fake->randomDigitNotNull,
            'interval' => $fake->randomDigitNotNull,
            'unit_time' => $fake->word,
            'business_days' => $fake->randomDigitNotNull,
            'sub_add_day' => $fake->randomDigitNotNull,
            'code' => $fake->word,
            'observations' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $periodFields);
    }
}
