<?php

use Faker\Factory as Faker;
use App\Models\propertyservice;
use App\Repositories\propertyserviceRepository;

trait MakepropertyserviceTrait
{
    /**
     * Create fake instance of propertyservice and save it in database
     *
     * @param array $propertyserviceFields
     * @return propertyservice
     */
    public function makepropertyservice($propertyserviceFields = [])
    {
        /** @var propertyserviceRepository $propertyserviceRepo */
        $propertyserviceRepo = App::make(propertyserviceRepository::class);
        $theme = $this->fakepropertyserviceData($propertyserviceFields);
        return $propertyserviceRepo->create($theme);
    }

    /**
     * Get fake instance of propertyservice
     *
     * @param array $propertyserviceFields
     * @return propertyservice
     */
    public function fakepropertyservice($propertyserviceFields = [])
    {
        return new propertyservice($this->fakepropertyserviceData($propertyserviceFields));
    }

    /**
     * Get fake data of propertyservice
     *
     * @param array $postFields
     * @return array
     */
    public function fakepropertyserviceData($propertyserviceFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'cve' => $fake->word,
            'shortname' => $fake->word,
            'name' => $fake->word,
            'description' => $fake->word,
            'content' => $fake->word,
            'privileges' => $fake->word,
            'obligations' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $propertyserviceFields);
    }
}
