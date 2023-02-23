<?php

use Faker\Factory as Faker;
use App\Models\currencytype;
use App\Repositories\currencytypeRepository;

trait MakecurrencytypeTrait
{
    /**
     * Create fake instance of currencytype and save it in database
     *
     * @param array $currencytypeFields
     * @return currencytype
     */
    public function makecurrencytype($currencytypeFields = [])
    {
        /** @var currencytypeRepository $currencytypeRepo */
        $currencytypeRepo = App::make(currencytypeRepository::class);
        $theme = $this->fakecurrencytypeData($currencytypeFields);
        return $currencytypeRepo->create($theme);
    }

    /**
     * Get fake instance of currencytype
     *
     * @param array $currencytypeFields
     * @return currencytype
     */
    public function fakecurrencytype($currencytypeFields = [])
    {
        return new currencytype($this->fakecurrencytypeData($currencytypeFields));
    }

    /**
     * Get fake data of currencytype
     *
     * @param array $postFields
     * @return array
     */
    public function fakecurrencytypeData($currencytypeFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'territory' => $fake->word,
            'currency' => $fake->word,
            'symbol' => $fake->word,
            'iso_code' => $fake->word,
            'fractional_unit' => $fake->word,
            'base_number' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $currencytypeFields);
    }
}
