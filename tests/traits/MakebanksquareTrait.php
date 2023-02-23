<?php

use Faker\Factory as Faker;
use App\Models\banksquare;
use App\Repositories\banksquareRepository;

trait MakebanksquareTrait
{
    /**
     * Create fake instance of banksquare and save it in database
     *
     * @param array $banksquareFields
     * @return banksquare
     */
    public function makebanksquare($banksquareFields = [])
    {
        /** @var banksquareRepository $banksquareRepo */
        $banksquareRepo = App::make(banksquareRepository::class);
        $theme = $this->fakebanksquareData($banksquareFields);
        return $banksquareRepo->create($theme);
    }

    /**
     * Get fake instance of banksquare
     *
     * @param array $banksquareFields
     * @return banksquare
     */
    public function fakebanksquare($banksquareFields = [])
    {
        return new banksquare($this->fakebanksquareData($banksquareFields));
    }

    /**
     * Get fake data of banksquare
     *
     * @param array $postFields
     * @return array
     */
    public function fakebanksquareData($banksquareFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'cve' => $fake->word,
            'square' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $banksquareFields);
    }
}
