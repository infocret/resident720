<?php

use Faker\Factory as Faker;
use App\Models\providers;
use App\Repositories\providersRepository;

trait MakeprovidersTrait
{
    /**
     * Create fake instance of providers and save it in database
     *
     * @param array $providersFields
     * @return providers
     */
    public function makeproviders($providersFields = [])
    {
        /** @var providersRepository $providersRepo */
        $providersRepo = App::make(providersRepository::class);
        $theme = $this->fakeprovidersData($providersFields);
        return $providersRepo->create($theme);
    }

    /**
     * Get fake instance of providers
     *
     * @param array $providersFields
     * @return providers
     */
    public function fakeproviders($providersFields = [])
    {
        return new providers($this->fakeprovidersData($providersFields));
    }

    /**
     * Get fake data of providers
     *
     * @param array $postFields
     * @return array
     */
    public function fakeprovidersData($providersFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'persona_id' => $fake->randomDigitNotNull,
            'tipo' => $fake->word,
            'nomcorto' => $fake->word,
            'razonsocial' => $fake->word,
            'rfcmoral' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $providersFields);
    }
}
