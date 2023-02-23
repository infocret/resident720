<?php

use Faker\Factory as Faker;
use App\Models\ticket;
use App\Repositories\ticketRepository;

trait MaketicketTrait
{
    /**
     * Create fake instance of ticket and save it in database
     *
     * @param array $ticketFields
     * @return ticket
     */
    public function maketicket($ticketFields = [])
    {
        /** @var ticketRepository $ticketRepo */
        $ticketRepo = App::make(ticketRepository::class);
        $theme = $this->faketicketData($ticketFields);
        return $ticketRepo->create($theme);
    }

    /**
     * Get fake instance of ticket
     *
     * @param array $ticketFields
     * @return ticket
     */
    public function faketicket($ticketFields = [])
    {
        return new ticket($this->faketicketData($ticketFields));
    }

    /**
     * Get fake data of ticket
     *
     * @param array $postFields
     * @return array
     */
    public function faketicketData($ticketFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'inmueble_id' => $fake->randomDigitNotNull,
            'propertyarea_id' => $fake->randomDigitNotNull,
            'folio' => $fake->word,
            'description' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $ticketFields);
    }
}
