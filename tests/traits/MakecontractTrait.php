<?php

use Faker\Factory as Faker;
use App\Models\contract;
use App\Repositories\contractRepository;

trait MakecontractTrait
{
    /**
     * Create fake instance of contract and save it in database
     *
     * @param array $contractFields
     * @return contract
     */
    public function makecontract($contractFields = [])
    {
        /** @var contractRepository $contractRepo */
        $contractRepo = App::make(contractRepository::class);
        $theme = $this->fakecontractData($contractFields);
        return $contractRepo->create($theme);
    }

    /**
     * Get fake instance of contract
     *
     * @param array $contractFields
     * @return contract
     */
    public function fakecontract($contractFields = [])
    {
        return new contract($this->fakecontractData($contractFields));
    }

    /**
     * Get fake data of contract
     *
     * @param array $postFields
     * @return array
     */
    public function fakecontractData($contractFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'cve' => $fake->word,
            'shortname' => $fake->word,
            'name' => $fake->word,
            'descripcion' => $fake->word,
            'content' => $fake->word,
            'privileges' => $fake->word,
            'obligations' => $fake->word,
            'observations' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $contractFields);
    }
}
