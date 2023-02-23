<?php

use Faker\Factory as Faker;
use App\Models\activitytracking;
use App\Repositories\activitytrackingRepository;

trait MakeactivitytrackingTrait
{
    /**
     * Create fake instance of activitytracking and save it in database
     *
     * @param array $activitytrackingFields
     * @return activitytracking
     */
    public function makeactivitytracking($activitytrackingFields = [])
    {
        /** @var activitytrackingRepository $activitytrackingRepo */
        $activitytrackingRepo = App::make(activitytrackingRepository::class);
        $theme = $this->fakeactivitytrackingData($activitytrackingFields);
        return $activitytrackingRepo->create($theme);
    }

    /**
     * Get fake instance of activitytracking
     *
     * @param array $activitytrackingFields
     * @return activitytracking
     */
    public function fakeactivitytracking($activitytrackingFields = [])
    {
        return new activitytracking($this->fakeactivitytrackingData($activitytrackingFields));
    }

    /**
     * Get fake data of activitytracking
     *
     * @param array $postFields
     * @return array
     */
    public function fakeactivitytrackingData($activitytrackingFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'movtobankaccount_id' => $fake->randomDigitNotNull,
            'movtohead_id' => $fake->randomDigitNotNull,
            'checkbook_id' => $fake->randomDigitNotNull,
            'bankaccount_id' => $fake->randomDigitNotNull,
            'user_id' => $fake->randomDigitNotNull,
            'act_type' => $fake->word,
            'activity_date' => $fake->word,
            'status_applied' => $fake->word,
            'observations' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $activitytrackingFields);
    }
}
