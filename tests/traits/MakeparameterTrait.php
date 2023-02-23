<?php

use Faker\Factory as Faker;
use App\Models\parameter;
use App\Repositories\parameterRepository;

trait MakeparameterTrait
{
    /**
     * Create fake instance of parameter and save it in database
     *
     * @param array $parameterFields
     * @return parameter
     */
    public function makeparameter($parameterFields = [])
    {
        /** @var parameterRepository $parameterRepo */
        $parameterRepo = App::make(parameterRepository::class);
        $theme = $this->fakeparameterData($parameterFields);
        return $parameterRepo->create($theme);
    }

    /**
     * Get fake instance of parameter
     *
     * @param array $parameterFields
     * @return parameter
     */
    public function fakeparameter($parameterFields = [])
    {
        return new parameter($this->fakeparameterData($parameterFields));
    }

    /**
     * Get fake data of parameter
     *
     * @param array $postFields
     * @return array
     */
    public function fakeparameterData($parameterFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'clave' => $fake->word,
            'descripcion' => $fake->word,
            'tipo' => $fake->word,
            'default' => $fake->word,
            'observaciones' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $parameterFields);
    }
}
