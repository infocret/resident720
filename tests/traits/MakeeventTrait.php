<?php

use Faker\Factory as Faker;
use App\Models\event;
use App\Repositories\eventRepository;

trait MakeeventTrait
{
    /**
     * Create fake instance of event and save it in database
     *
     * @param array $eventFields
     * @return event
     */
    public function makeevent($eventFields = [])
    {
        /** @var eventRepository $eventRepo */
        $eventRepo = App::make(eventRepository::class);
        $theme = $this->fakeeventData($eventFields);
        return $eventRepo->create($theme);
    }

    /**
     * Get fake instance of event
     *
     * @param array $eventFields
     * @return event
     */
    public function fakeevent($eventFields = [])
    {
        return new event($this->fakeeventData($eventFields));
    }

    /**
     * Get fake data of event
     *
     * @param array $postFields
     * @return array
     */
    public function fakeeventData($eventFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'title' => $fake->word,
            'start_date' => $fake->word,
            'end_date' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $eventFields);
    }
}
