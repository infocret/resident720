<?php

use Faker\Factory as Faker;
use App\Models\movtobankaccount;
use App\Repositories\movtobankaccountRepository;

trait MakemovtobankaccountTrait
{
    /**
     * Create fake instance of movtobankaccount and save it in database
     *
     * @param array $movtobankaccountFields
     * @return movtobankaccount
     */
    public function makemovtobankaccount($movtobankaccountFields = [])
    {
        /** @var movtobankaccountRepository $movtobankaccountRepo */
        $movtobankaccountRepo = App::make(movtobankaccountRepository::class);
        $theme = $this->fakemovtobankaccountData($movtobankaccountFields);
        return $movtobankaccountRepo->create($theme);
    }

    /**
     * Get fake instance of movtobankaccount
     *
     * @param array $movtobankaccountFields
     * @return movtobankaccount
     */
    public function fakemovtobankaccount($movtobankaccountFields = [])
    {
        return new movtobankaccount($this->fakemovtobankaccountData($movtobankaccountFields));
    }

    /**
     * Get fake data of movtobankaccount
     *
     * @param array $postFields
     * @return array
     */
    public function fakemovtobankaccountData($movtobankaccountFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'movtohead_id' => $fake->randomDigitNotNull,
            'checkbook_id' => $fake->randomDigitNotNull,
            'bankaccount_id' => $fake->randomDigitNotNull,
            'nchbook_ntrx_ref' => $fake->word,
            'owner' => $fake->word,
            'amount' => $fake->word,
            'partial_payment' => $fake->randomDigitNotNull,
            'observations' => $fake->word,
            'Head_balance_Amount' => $fake->word,
            'status' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $movtobankaccountFields);
    }
}
