<?php

use Faker\Factory as Faker;
use App\Models\checkissuance;
use App\Repositories\checkissuanceRepository;

trait MakecheckissuanceTrait
{
    /**
     * Create fake instance of checkissuance and save it in database
     *
     * @param array $checkissuanceFields
     * @return checkissuance
     */
    public function makecheckissuance($checkissuanceFields = [])
    {
        /** @var checkissuanceRepository $checkissuanceRepo */
        $checkissuanceRepo = App::make(checkissuanceRepository::class);
        $theme = $this->fakecheckissuanceData($checkissuanceFields);
        return $checkissuanceRepo->create($theme);
    }

    /**
     * Get fake instance of checkissuance
     *
     * @param array $checkissuanceFields
     * @return checkissuance
     */
    public function fakecheckissuance($checkissuanceFields = [])
    {
        return new checkissuance($this->fakecheckissuanceData($checkissuanceFields));
    }

    /**
     * Get fake data of checkissuance
     *
     * @param array $postFields
     * @return array
     */
    public function fakecheckissuanceData($checkissuanceFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'inmucharge_id' => $fake->randomDigitNotNull,
            'propaccount_id' => $fake->randomDigitNotNull,
            'checkbook_id' => $fake->randomDigitNotNull,
            'incluirleyenda' => $fake->word,
            'datetext' => $fake->word,
            'nametext' => $fake->word,
            'amounttext' => $fake->word,
            'amountletertext' => $fake->word,
            'textleyenda' => $fake->word,
            'status' => $fake->word,
            'checknum' => $fake->word,
            'cancelchargeid' => $fake->word,
            'observ' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $checkissuanceFields);
    }
}
