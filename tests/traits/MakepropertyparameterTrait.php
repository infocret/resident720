<?php

use Faker\Factory as Faker;
use App\Models\propertyparameter;
use App\Repositories\propertyparameterRepository;

trait MakepropertyparameterTrait
{
    /**
     * Create fake instance of propertyparameter and save it in database
     *
     * @param array $propertyparameterFields
     * @return propertyparameter
     */
    public function makepropertyparameter($propertyparameterFields = [])
    {
        /** @var propertyparameterRepository $propertyparameterRepo */
        $propertyparameterRepo = App::make(propertyparameterRepository::class);
        $theme = $this->fakepropertyparameterData($propertyparameterFields);
        return $propertyparameterRepo->create($theme);
    }

    /**
     * Get fake instance of propertyparameter
     *
     * @param array $propertyparameterFields
     * @return propertyparameter
     */
    public function fakepropertyparameter($propertyparameterFields = [])
    {
        return new propertyparameter($this->fakepropertyparameterData($propertyparameterFields));
    }

    /**
     * Get fake data of propertyparameter
     *
     * @param array $postFields
     * @return array
     */
    public function fakepropertyparameterData($propertyparameterFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'inmueble_id' => $fake->randomDigitNotNull,
            'parametro' => $fake->word,
            'valor' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $propertyparameterFields);
    }
}
