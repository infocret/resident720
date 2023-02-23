<?php

use Faker\Factory as Faker;
use App\Models\inmucharge;
use App\Repositories\inmuchargeRepository;

trait MakeinmuchargeTrait
{
    /**
     * Create fake instance of inmucharge and save it in database
     *
     * @param array $inmuchargeFields
     * @return inmucharge
     */
    public function makeinmucharge($inmuchargeFields = [])
    {
        /** @var inmuchargeRepository $inmuchargeRepo */
        $inmuchargeRepo = App::make(inmuchargeRepository::class);
        $theme = $this->fakeinmuchargeData($inmuchargeFields);
        return $inmuchargeRepo->create($theme);
    }

    /**
     * Get fake instance of inmucharge
     *
     * @param array $inmuchargeFields
     * @return inmucharge
     */
    public function fakeinmucharge($inmuchargeFields = [])
    {
        return new inmucharge($this->fakeinmuchargeData($inmuchargeFields));
    }

    /**
     * Get fake data of inmucharge
     *
     * @param array $postFields
     * @return array
     */
    public function fakeinmuchargeData($inmuchargeFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'inmu_id' => $fake->randomDigitNotNull,
            'conceptserv_id' => $fake->randomDigitNotNull,
            'proparea_id' => $fake->randomDigitNotNull,
            'provider_id' => $fake->randomDigitNotNull,
            'date' => $fake->word,
            'folio' => $fake->word,
            'stotal' => $fake->word,
            'iva' => $fake->word,
            'balance' => $fake->word,
            'status' => $fake->word,
            'description' => $fake->word,
            'observ' => $fake->word,
            'filelink' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word,
            'deleted_at' => $fake->word
        ], $inmuchargeFields);
    }
}
