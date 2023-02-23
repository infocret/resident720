<?php

use Faker\Factory as Faker;
use App\Models\statusticketimg;
use App\Repositories\statusticketimgRepository;

trait MakestatusticketimgTrait
{
    /**
     * Create fake instance of statusticketimg and save it in database
     *
     * @param array $statusticketimgFields
     * @return statusticketimg
     */
    public function makestatusticketimg($statusticketimgFields = [])
    {
        /** @var statusticketimgRepository $statusticketimgRepo */
        $statusticketimgRepo = App::make(statusticketimgRepository::class);
        $theme = $this->fakestatusticketimgData($statusticketimgFields);
        return $statusticketimgRepo->create($theme);
    }

    /**
     * Get fake instance of statusticketimg
     *
     * @param array $statusticketimgFields
     * @return statusticketimg
     */
    public function fakestatusticketimg($statusticketimgFields = [])
    {
        return new statusticketimg($this->fakestatusticketimgData($statusticketimgFields));
    }

    /**
     * Get fake data of statusticketimg
     *
     * @param array $postFields
     * @return array
     */
    public function fakestatusticketimgData($statusticketimgFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'statusticket_id' => $fake->randomDigitNotNull,
            'filename' => $fake->word,
            'link' => $fake->word,
            'observations' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $statusticketimgFields);
    }
}
