<?php

use Faker\Factory as Faker;
use App\Models\perioddate;
use App\Repositories\perioddateRepository;

trait MakeperioddateTrait
{
    /**
     * Create fake instance of perioddate and save it in database
     *
     * @param array $perioddateFields
     * @return perioddate
     */
    public function makeperioddate($perioddateFields = [])
    {
        /** @var perioddateRepository $perioddateRepo */
        $perioddateRepo = App::make(perioddateRepository::class);
        $theme = $this->fakeperioddateData($perioddateFields);
        return $perioddateRepo->create($theme);
    }

    /**
     * Get fake instance of perioddate
     *
     * @param array $perioddateFields
     * @return perioddate
     */
    public function fakeperioddate($perioddateFields = [])
    {
        return new perioddate($this->fakeperioddateData($perioddateFields));
    }

    /**
     * Get fake data of perioddate
     *
     * @param array $postFields
     * @return array
     */
    public function fakeperioddateData($perioddateFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'period_id' => $fake->randomDigitNotNull,
            'date' => $fake->word,
            'yearday' => $fake->randomDigitNotNull,
            'action' => $fake->word,
            'status' => $fake->word,
            'observations' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $perioddateFields);
    }
}
