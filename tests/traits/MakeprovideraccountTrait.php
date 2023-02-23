<?php

use Faker\Factory as Faker;
use App\Models\provideraccount;
use App\Repositories\provideraccountRepository;

trait MakeprovideraccountTrait
{
    /**
     * Create fake instance of provideraccount and save it in database
     *
     * @param array $provideraccountFields
     * @return provideraccount
     */
    public function makeprovideraccount($provideraccountFields = [])
    {
        /** @var provideraccountRepository $provideraccountRepo */
        $provideraccountRepo = App::make(provideraccountRepository::class);
        $theme = $this->fakeprovideraccountData($provideraccountFields);
        return $provideraccountRepo->create($theme);
    }

    /**
     * Get fake instance of provideraccount
     *
     * @param array $provideraccountFields
     * @return provideraccount
     */
    public function fakeprovideraccount($provideraccountFields = [])
    {
        return new provideraccount($this->fakeprovideraccountData($provideraccountFields));
    }

    /**
     * Get fake data of provideraccount
     *
     * @param array $postFields
     * @return array
     */
    public function fakeprovideraccountData($provideraccountFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'provider_id' => $fake->randomDigitNotNull,
            'bankaccount_id' => $fake->randomDigitNotNull,
            'checkbook_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $provideraccountFields);
    }
}
