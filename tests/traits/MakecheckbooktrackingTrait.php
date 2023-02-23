<?php

use Faker\Factory as Faker;
use App\Models\checkbooktracking;
use App\Repositories\checkbooktrackingRepository;

trait MakecheckbooktrackingTrait
{
    /**
     * Create fake instance of checkbooktracking and save it in database
     *
     * @param array $checkbooktrackingFields
     * @return checkbooktracking
     */
    public function makecheckbooktracking($checkbooktrackingFields = [])
    {
        /** @var checkbooktrackingRepository $checkbooktrackingRepo */
        $checkbooktrackingRepo = App::make(checkbooktrackingRepository::class);
        $theme = $this->fakecheckbooktrackingData($checkbooktrackingFields);
        return $checkbooktrackingRepo->create($theme);
    }

    /**
     * Get fake instance of checkbooktracking
     *
     * @param array $checkbooktrackingFields
     * @return checkbooktracking
     */
    public function fakecheckbooktracking($checkbooktrackingFields = [])
    {
        return new checkbooktracking($this->fakecheckbooktrackingData($checkbooktrackingFields));
    }

    /**
     * Get fake data of checkbooktracking
     *
     * @param array $postFields
     * @return array
     */
    public function fakecheckbooktrackingData($checkbooktrackingFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'checkissuance_id' => $fake->randomDigitNotNull,
            'user_id' => $fake->randomDigitNotNull,
            'datereg' => $fake->word,
            'status' => $fake->word,
            'observ' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $checkbooktrackingFields);
    }
}
