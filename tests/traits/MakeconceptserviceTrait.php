<?php

use Faker\Factory as Faker;
use App\Models\conceptservice;
use App\Repositories\conceptserviceRepository;

trait MakeconceptserviceTrait
{
    /**
     * Create fake instance of conceptservice and save it in database
     *
     * @param array $conceptserviceFields
     * @return conceptservice
     */
    public function makeconceptservice($conceptserviceFields = [])
    {
        /** @var conceptserviceRepository $conceptserviceRepo */
        $conceptserviceRepo = App::make(conceptserviceRepository::class);
        $theme = $this->fakeconceptserviceData($conceptserviceFields);
        return $conceptserviceRepo->create($theme);
    }

    /**
     * Get fake instance of conceptservice
     *
     * @param array $conceptserviceFields
     * @return conceptservice
     */
    public function fakeconceptservice($conceptserviceFields = [])
    {
        return new conceptservice($this->fakeconceptserviceData($conceptserviceFields));
    }

    /**
     * Get fake data of conceptservice
     *
     * @param array $postFields
     * @return array
     */
    public function fakeconceptserviceData($conceptserviceFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'cve' => $fake->randomDigitNotNull,
            'shortname' => $fake->word,
            'name' => $fake->word,
            'description' => $fake->word,
            'observ' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word,
            'deleted_at' => $fake->word
        ], $conceptserviceFields);
    }
}
