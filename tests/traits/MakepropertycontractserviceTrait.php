<?php

use Faker\Factory as Faker;
use App\Models\propertycontractservice;
use App\Repositories\propertycontractserviceRepository;

trait MakepropertycontractserviceTrait
{
    /**
     * Create fake instance of propertycontractservice and save it in database
     *
     * @param array $propertycontractserviceFields
     * @return propertycontractservice
     */
    public function makepropertycontractservice($propertycontractserviceFields = [])
    {
        /** @var propertycontractserviceRepository $propertycontractserviceRepo */
        $propertycontractserviceRepo = App::make(propertycontractserviceRepository::class);
        $theme = $this->fakepropertycontractserviceData($propertycontractserviceFields);
        return $propertycontractserviceRepo->create($theme);
    }

    /**
     * Get fake instance of propertycontractservice
     *
     * @param array $propertycontractserviceFields
     * @return propertycontractservice
     */
    public function fakepropertycontractservice($propertycontractserviceFields = [])
    {
        return new propertycontractservice($this->fakepropertycontractserviceData($propertycontractserviceFields));
    }

    /**
     * Get fake data of propertycontractservice
     *
     * @param array $postFields
     * @return array
     */
    public function fakepropertycontractserviceData($propertycontractserviceFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'contract_id' => $fake->randomDigitNotNull,
            'propertyservice_id' => $fake->randomDigitNotNull,
            'period_id' => $fake->randomDigitNotNull,
            'amount' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $propertycontractserviceFields);
    }
}
