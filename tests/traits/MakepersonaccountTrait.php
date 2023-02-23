<?php

use Faker\Factory as Faker;
use App\Models\personaccount;
use App\Repositories\personaccountRepository;

trait MakepersonaccountTrait
{
    /**
     * Create fake instance of personaccount and save it in database
     *
     * @param array $personaccountFields
     * @return personaccount
     */
    public function makepersonaccount($personaccountFields = [])
    {
        /** @var personaccountRepository $personaccountRepo */
        $personaccountRepo = App::make(personaccountRepository::class);
        $theme = $this->fakepersonaccountData($personaccountFields);
        return $personaccountRepo->create($theme);
    }

    /**
     * Get fake instance of personaccount
     *
     * @param array $personaccountFields
     * @return personaccount
     */
    public function fakepersonaccount($personaccountFields = [])
    {
        return new personaccount($this->fakepersonaccountData($personaccountFields));
    }

    /**
     * Get fake data of personaccount
     *
     * @param array $postFields
     * @return array
     */
    public function fakepersonaccountData($personaccountFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'persona_id' => $fake->randomDigitNotNull,
            'bankaccount_id' => $fake->randomDigitNotNull,
            'checkbook_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $personaccountFields);
    }
}
