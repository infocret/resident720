<?php

use Faker\Factory as Faker;
use App\Models\propertyareas;
use App\Repositories\propertyareasRepository;

trait MakepropertyareasTrait
{
    /**
     * Create fake instance of propertyareas and save it in database
     *
     * @param array $propertyareasFields
     * @return propertyareas
     */
    public function makepropertyareas($propertyareasFields = [])
    {
        /** @var propertyareasRepository $propertyareasRepo */
        $propertyareasRepo = App::make(propertyareasRepository::class);
        $theme = $this->fakepropertyareasData($propertyareasFields);
        return $propertyareasRepo->create($theme);
    }

    /**
     * Get fake instance of propertyareas
     *
     * @param array $propertyareasFields
     * @return propertyareas
     */
    public function fakepropertyareas($propertyareasFields = [])
    {
        return new propertyareas($this->fakepropertyareasData($propertyareasFields));
    }

    /**
     * Get fake data of propertyareas
     *
     * @param array $postFields
     * @return array
     */
    public function fakepropertyareasData($propertyareasFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'inmueble_id' => $fake->randomDigitNotNull,
            'nombre' => $fake->word,
            'descripcion' => $fake->word,
            'planta' => $fake->word,
            'filename' => $fake->word,
            'filepath' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $propertyareasFields);
    }
}
