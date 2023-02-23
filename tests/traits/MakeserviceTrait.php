<?php

use Faker\Factory as Faker;
use App\Models\service;
use App\Repositories\serviceRepository;

trait MakeserviceTrait
{
    /**
     * Create fake instance of service and save it in database
     *
     * @param array $serviceFields
     * @return service
     */
    public function makeservice($serviceFields = [])
    {
        /** @var serviceRepository $serviceRepo */
        $serviceRepo = App::make(serviceRepository::class);
        $theme = $this->fakeserviceData($serviceFields);
        return $serviceRepo->create($theme);
    }

    /**
     * Get fake instance of service
     *
     * @param array $serviceFields
     * @return service
     */
    public function fakeservice($serviceFields = [])
    {
        return new service($this->fakeserviceData($serviceFields));
    }

    /**
     * Get fake data of service
     *
     * @param array $postFields
     * @return array
     */
    public function fakeserviceData($serviceFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nomcorto' => $fake->word,
            'nombre' => $fake->word,
            'descripcion' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $serviceFields);
    }
}
