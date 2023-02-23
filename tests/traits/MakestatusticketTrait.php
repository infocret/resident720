<?php

use Faker\Factory as Faker;
use App\Models\statusticket;
use App\Repositories\statusticketRepository;

trait MakestatusticketTrait
{
    /**
     * Create fake instance of statusticket and save it in database
     *
     * @param array $statusticketFields
     * @return statusticket
     */
    public function makestatusticket($statusticketFields = [])
    {
        /** @var statusticketRepository $statusticketRepo */
        $statusticketRepo = App::make(statusticketRepository::class);
        $theme = $this->fakestatusticketData($statusticketFields);
        return $statusticketRepo->create($theme);
    }

    /**
     * Get fake instance of statusticket
     *
     * @param array $statusticketFields
     * @return statusticket
     */
    public function fakestatusticket($statusticketFields = [])
    {
        return new statusticket($this->fakestatusticketData($statusticketFields));
    }

    /**
     * Get fake data of statusticket
     *
     * @param array $postFields
     * @return array
     */
    public function fakestatusticketData($statusticketFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'ticket_id' => $fake->randomDigitNotNull,
            'user_id' => $fake->randomDigitNotNull,
            'status_date' => $fake->word,
            'status' => $fake->word,
            'observations' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $statusticketFields);
    }
}
