<?php

use Faker\Factory as Faker;
use App\Models\movdetailapplie;
use App\Repositories\movdetailapplieRepository;

trait MakemovdetailapplieTrait
{
    /**
     * Create fake instance of movdetailapplie and save it in database
     *
     * @param array $movdetailapplieFields
     * @return movdetailapplie
     */
    public function makemovdetailapplie($movdetailapplieFields = [])
    {
        /** @var movdetailapplieRepository $movdetailapplieRepo */
        $movdetailapplieRepo = App::make(movdetailapplieRepository::class);
        $theme = $this->fakemovdetailapplieData($movdetailapplieFields);
        return $movdetailapplieRepo->create($theme);
    }

    /**
     * Get fake instance of movdetailapplie
     *
     * @param array $movdetailapplieFields
     * @return movdetailapplie
     */
    public function fakemovdetailapplie($movdetailapplieFields = [])
    {
        return new movdetailapplie($this->fakemovdetailapplieData($movdetailapplieFields));
    }

    /**
     * Get fake data of movdetailapplie
     *
     * @param array $postFields
     * @return array
     */
    public function fakemovdetailapplieData($movdetailapplieFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'movtobankaccount_id' => $fake->randomDigitNotNull,
            'movtodetail_id' => $fake->randomDigitNotNull,
            'applie_date' => $fake->word,
            'amount_applied' => $fake->word,
            'detail_balance_amount' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $movdetailapplieFields);
    }
}
