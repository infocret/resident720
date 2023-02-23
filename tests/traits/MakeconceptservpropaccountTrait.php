<?php

use Faker\Factory as Faker;
use App\Models\conceptservpropaccount;
use App\Repositories\conceptservpropaccountRepository;

trait MakeconceptservpropaccountTrait
{
    /**
     * Create fake instance of conceptservpropaccount and save it in database
     *
     * @param array $conceptservpropaccountFields
     * @return conceptservpropaccount
     */
    public function makeconceptservpropaccount($conceptservpropaccountFields = [])
    {
        /** @var conceptservpropaccountRepository $conceptservpropaccountRepo */
        $conceptservpropaccountRepo = App::make(conceptservpropaccountRepository::class);
        $theme = $this->fakeconceptservpropaccountData($conceptservpropaccountFields);
        return $conceptservpropaccountRepo->create($theme);
    }

    /**
     * Get fake instance of conceptservpropaccount
     *
     * @param array $conceptservpropaccountFields
     * @return conceptservpropaccount
     */
    public function fakeconceptservpropaccount($conceptservpropaccountFields = [])
    {
        return new conceptservpropaccount($this->fakeconceptservpropaccountData($conceptservpropaccountFields));
    }

    /**
     * Get fake data of conceptservpropaccount
     *
     * @param array $postFields
     * @return array
     */
    public function fakeconceptservpropaccountData($conceptservpropaccountFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'conceptservices_id' => $fake->randomDigitNotNull,
            'propaccounts_id' => $fake->randomDigitNotNull,
            't_use' => $fake->word,
            'bank_agreement' => $fake->word,
            'bank_reference' => $fake->word,
            'reciptext' => $fake->word,
            'description' => $fake->word,
            'observ' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word,
            'deleted_at' => $fake->word
        ], $conceptservpropaccountFields);
    }
}
