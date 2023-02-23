<?php

use Faker\Factory as Faker;
use App\Models\propertyvalue;
use App\Repositories\propertyvalueRepository;

trait MakepropertyvalueTrait
{
    /**
     * Create fake instance of propertyvalue and save it in database
     *
     * @param array $propertyvalueFields
     * @return propertyvalue
     */
    public function makepropertyvalue($propertyvalueFields = [])
    {
        /** @var propertyvalueRepository $propertyvalueRepo */
        $propertyvalueRepo = App::make(propertyvalueRepository::class);
        $theme = $this->fakepropertyvalueData($propertyvalueFields);
        return $propertyvalueRepo->create($theme);
    }

    /**
     * Get fake instance of propertyvalue
     *
     * @param array $propertyvalueFields
     * @return propertyvalue
     */
    public function fakepropertyvalue($propertyvalueFields = [])
    {
        return new propertyvalue($this->fakepropertyvalueData($propertyvalueFields));
    }

    /**
     * Get fake data of propertyvalue
     *
     * @param array $postFields
     * @return array
     */
    public function fakepropertyvalueData($propertyvalueFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'inmueble_id' => $fake->randomDigitNotNull,
            'area' => $fake->word,
            'porcentaje' => $fake->word,
            'valor' => $fake->word,
            'presupuesto' => $fake->word,
            'cuota' => $fake->word,
            'indiv1' => $fake->word,
            'indiv2' => $fake->word,
            'indiv3' => $fake->word,
            'indiv4' => $fake->word,
            'indiv5' => $fake->word,
            'param1' => $fake->word,
            'param2' => $fake->word,
            'param3' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $propertyvalueFields);
    }
}
