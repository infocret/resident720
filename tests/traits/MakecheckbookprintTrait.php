<?php

use Faker\Factory as Faker;
use App\Models\checkbookprint;
use App\Repositories\checkbookprintRepository;

trait MakecheckbookprintTrait
{
    /**
     * Create fake instance of checkbookprint and save it in database
     *
     * @param array $checkbookprintFields
     * @return checkbookprint
     */
    public function makecheckbookprint($checkbookprintFields = [])
    {
        /** @var checkbookprintRepository $checkbookprintRepo */
        $checkbookprintRepo = App::make(checkbookprintRepository::class);
        $theme = $this->fakecheckbookprintData($checkbookprintFields);
        return $checkbookprintRepo->create($theme);
    }

    /**
     * Get fake instance of checkbookprint
     *
     * @param array $checkbookprintFields
     * @return checkbookprint
     */
    public function fakecheckbookprint($checkbookprintFields = [])
    {
        return new checkbookprint($this->fakecheckbookprintData($checkbookprintFields));
    }

    /**
     * Get fake data of checkbookprint
     *
     * @param array $postFields
     * @return array
     */
    public function fakecheckbookprintData($checkbookprintFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'checkbook_id' => $fake->randomDigitNotNull,
            'desc' => $fake->word,
            'imgsample' => $fake->word,
            'cssfile' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $checkbookprintFields);
    }
}
