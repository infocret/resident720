<?php

use Faker\Factory as Faker;
use App\Models\provcats;
use App\Repositories\provcatsRepository;

trait MakeprovcatsTrait
{
    /**
     * Create fake instance of provcats and save it in database
     *
     * @param array $provcatsFields
     * @return provcats
     */
    public function makeprovcats($provcatsFields = [])
    {
        /** @var provcatsRepository $provcatsRepo */
        $provcatsRepo = App::make(provcatsRepository::class);
        $theme = $this->fakeprovcatsData($provcatsFields);
        return $provcatsRepo->create($theme);
    }

    /**
     * Get fake instance of provcats
     *
     * @param array $provcatsFields
     * @return provcats
     */
    public function fakeprovcats($provcatsFields = [])
    {
        return new provcats($this->fakeprovcatsData($provcatsFields));
    }

    /**
     * Get fake data of provcats
     *
     * @param array $postFields
     * @return array
     */
    public function fakeprovcatsData($provcatsFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'tipo' => $fake->word,
            'categoria' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $provcatsFields);
    }
}
