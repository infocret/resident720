<?php

use Faker\Factory as Faker;
use App\Models\categorieProviders;
use App\Repositories\categorieProvidersRepository;

trait MakecategorieProvidersTrait
{
    /**
     * Create fake instance of categorieProviders and save it in database
     *
     * @param array $categorieProvidersFields
     * @return categorieProviders
     */
    public function makecategorieProviders($categorieProvidersFields = [])
    {
        /** @var categorieProvidersRepository $categorieProvidersRepo */
        $categorieProvidersRepo = App::make(categorieProvidersRepository::class);
        $theme = $this->fakecategorieProvidersData($categorieProvidersFields);
        return $categorieProvidersRepo->create($theme);
    }

    /**
     * Get fake instance of categorieProviders
     *
     * @param array $categorieProvidersFields
     * @return categorieProviders
     */
    public function fakecategorieProviders($categorieProvidersFields = [])
    {
        return new categorieProviders($this->fakecategorieProvidersData($categorieProvidersFields));
    }

    /**
     * Get fake data of categorieProviders
     *
     * @param array $postFields
     * @return array
     */
    public function fakecategorieProvidersData($categorieProvidersFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'provcat_id' => $fake->randomDigitNotNull,
            'provider_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $categorieProvidersFields);
    }
}
