<?php

use Faker\Factory as Faker;
use App\Models\storage;
use App\Repositories\storageRepository;

trait MakestorageTrait
{
    /**
     * Create fake instance of storage and save it in database
     *
     * @param array $storageFields
     * @return storage
     */
    public function makestorage($storageFields = [])
    {
        /** @var storageRepository $storageRepo */
        $storageRepo = App::make(storageRepository::class);
        $theme = $this->fakestorageData($storageFields);
        return $storageRepo->create($theme);
    }

    /**
     * Get fake instance of storage
     *
     * @param array $storageFields
     * @return storage
     */
    public function fakestorage($storageFields = [])
    {
        return new storage($this->fakestorageData($storageFields));
    }

    /**
     * Get fake data of storage
     *
     * @param array $postFields
     * @return array
     */
    public function fakestorageData($storageFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'inmueble_id' => $fake->randomDigitNotNull,
            'propertyarea_id' => $fake->randomDigitNotNull,
            'shortname' => $fake->word,
            'name' => $fake->word,
            'observations' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $storageFields);
    }
}
