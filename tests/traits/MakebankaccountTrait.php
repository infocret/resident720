<?php

use Faker\Factory as Faker;
use App\Models\bankaccount;
use App\Repositories\bankaccountRepository;

trait MakebankaccountTrait
{
    /**
     * Create fake instance of bankaccount and save it in database
     *
     * @param array $bankaccountFields
     * @return bankaccount
     */
    public function makebankaccount($bankaccountFields = [])
    {
        /** @var bankaccountRepository $bankaccountRepo */
        $bankaccountRepo = App::make(bankaccountRepository::class);
        $theme = $this->fakebankaccountData($bankaccountFields);
        return $bankaccountRepo->create($theme);
    }

    /**
     * Get fake instance of bankaccount
     *
     * @param array $bankaccountFields
     * @return bankaccount
     */
    public function fakebankaccount($bankaccountFields = [])
    {
        return new bankaccount($this->fakebankaccountData($bankaccountFields));
    }

    /**
     * Get fake data of bankaccount
     *
     * @param array $postFields
     * @return array
     */
    public function fakebankaccountData($bankaccountFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'bank_id' => $fake->randomDigitNotNull,
            'banksquare_id' => $fake->randomDigitNotNull,
            'ident' => $fake->word,
            'name' => $fake->word,
            'account' => $fake->word,
            'clabe' => $fake->word,
            'description' => $fake->word,
            'currency_type' => $fake->word,
            'opening_date' => $fake->word,
            'account_type' => $fake->word,
            'accounting' => $fake->word,
            'allow_overdrafts' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $bankaccountFields);
    }
}
