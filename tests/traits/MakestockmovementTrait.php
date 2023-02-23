<?php

use Faker\Factory as Faker;
use App\Models\stockmovement;
use App\Repositories\stockmovementRepository;

trait MakestockmovementTrait
{
    /**
     * Create fake instance of stockmovement and save it in database
     *
     * @param array $stockmovementFields
     * @return stockmovement
     */
    public function makestockmovement($stockmovementFields = [])
    {
        /** @var stockmovementRepository $stockmovementRepo */
        $stockmovementRepo = App::make(stockmovementRepository::class);
        $theme = $this->fakestockmovementData($stockmovementFields);
        return $stockmovementRepo->create($theme);
    }

    /**
     * Get fake instance of stockmovement
     *
     * @param array $stockmovementFields
     * @return stockmovement
     */
    public function fakestockmovement($stockmovementFields = [])
    {
        return new stockmovement($this->fakestockmovementData($stockmovementFields));
    }

    /**
     * Get fake data of stockmovement
     *
     * @param array $postFields
     * @return array
     */
    public function fakestockmovementData($stockmovementFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'storage_id' => $fake->randomDigitNotNull,
            'article_id' => $fake->randomDigitNotNull,
            'user_id' => $fake->randomDigitNotNull,
            'reference' => $fake->word,
            'date' => $fake->word,
            'quantity' => $fake->randomDigitNotNull,
            'mov_type' => $fake->word,
            'observations' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $stockmovementFields);
    }
}
