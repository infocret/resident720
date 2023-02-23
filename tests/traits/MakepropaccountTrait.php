<?php

use Faker\Factory as Faker;
use App\Models\propaccount;
use App\Repositories\propaccountRepository;

trait MakepropaccountTrait
{
    /**
     * Create fake instance of propaccount and save it in database
     *
     * @param array $propaccountFields
     * @return propaccount
     */
    public function makepropaccount($propaccountFields = [])
    {
        /** @var propaccountRepository $propaccountRepo */
        $propaccountRepo = App::make(propaccountRepository::class);
        $theme = $this->fakepropaccountData($propaccountFields);
        return $propaccountRepo->create($theme);
    }

    /**
     * Get fake instance of propaccount
     *
     * @param array $propaccountFields
     * @return propaccount
     */
    public function fakepropaccount($propaccountFields = [])
    {
        return new propaccount($this->fakepropaccountData($propaccountFields));
    }

    /**
     * Get fake data of propaccount
     *
     * @param array $postFields
     * @return array
     */
    public function fakepropaccountData($propaccountFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'inmueble_id' => $fake->randomDigitNotNull,
            'bankaccount_id' => $fake->randomDigitNotNull,
            'checkbook_id' => $fake->randomDigitNotNull,
            'bank_agreement' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $propaccountFields);
    }
}
