<?php

use Faker\Factory as Faker;
use App\Models\bank;
use App\Repositories\bankRepository;

trait MakebankTrait
{
    /**
     * Create fake instance of bank and save it in database
     *
     * @param array $bankFields
     * @return bank
     */
    public function makebank($bankFields = [])
    {
        /** @var bankRepository $bankRepo */
        $bankRepo = App::make(bankRepository::class);
        $theme = $this->fakebankData($bankFields);
        return $bankRepo->create($theme);
    }

    /**
     * Get fake instance of bank
     *
     * @param array $bankFields
     * @return bank
     */
    public function fakebank($bankFields = [])
    {
        return new bank($this->fakebankData($bankFields));
    }

    /**
     * Get fake data of bank
     *
     * @param array $postFields
     * @return array
     */
    public function fakebankData($bankFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'cve' => $fake->word,
            'ident' => $fake->word,
            'shortname' => $fake->word,
            'fullname' => $fake->word,
            'participates' => $fake->word,
            'website' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $bankFields);
    }
}
