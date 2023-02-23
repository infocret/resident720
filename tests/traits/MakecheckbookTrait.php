<?php

use Faker\Factory as Faker;
use App\Models\checkbook;
use App\Repositories\checkbookRepository;

trait MakecheckbookTrait
{
    /**
     * Create fake instance of checkbook and save it in database
     *
     * @param array $checkbookFields
     * @return checkbook
     */
    public function makecheckbook($checkbookFields = [])
    {
        /** @var checkbookRepository $checkbookRepo */
        $checkbookRepo = App::make(checkbookRepository::class);
        $theme = $this->fakecheckbookData($checkbookFields);
        return $checkbookRepo->create($theme);
    }

    /**
     * Get fake instance of checkbook
     *
     * @param array $checkbookFields
     * @return checkbook
     */
    public function fakecheckbook($checkbookFields = [])
    {
        return new checkbook($this->fakecheckbookData($checkbookFields));
    }

    /**
     * Get fake data of checkbook
     *
     * @param array $postFields
     * @return array
     */
    public function fakecheckbookData($checkbookFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'bankaccount_id' => $fake->randomDigitNotNull,
            'shortname' => $fake->word,
            'fullname' => $fake->word,
            'description' => $fake->word,
            'start' => $fake->word,
            'end' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $checkbookFields);
    }
}
