<?php

use Faker\Factory as Faker;
use App\Models\stock;
use App\Repositories\stockRepository;

trait MakestockTrait
{
    /**
     * Create fake instance of stock and save it in database
     *
     * @param array $stockFields
     * @return stock
     */
    public function makestock($stockFields = [])
    {
        /** @var stockRepository $stockRepo */
        $stockRepo = App::make(stockRepository::class);
        $theme = $this->fakestockData($stockFields);
        return $stockRepo->create($theme);
    }

    /**
     * Get fake instance of stock
     *
     * @param array $stockFields
     * @return stock
     */
    public function fakestock($stockFields = [])
    {
        return new stock($this->fakestockData($stockFields));
    }

    /**
     * Get fake data of stock
     *
     * @param array $postFields
     * @return array
     */
    public function fakestockData($stockFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'storage_id' => $fake->randomDigitNotNull,
            'article_id' => $fake->randomDigitNotNull,
            'stock' => $fake->randomDigitNotNull,
            'location' => $fake->word,
            'stock_max' => $fake->randomDigitNotNull,
            'stock_min' => $fake->randomDigitNotNull,
            'observations' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $stockFields);
    }
}
