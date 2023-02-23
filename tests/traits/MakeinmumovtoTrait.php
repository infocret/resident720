<?php

use Faker\Factory as Faker;
use App\Models\inmumovto;
use App\Repositories\inmumovtoRepository;

trait MakeinmumovtoTrait
{
    /**
     * Create fake instance of inmumovto and save it in database
     *
     * @param array $inmumovtoFields
     * @return inmumovto
     */
    public function makeinmumovto($inmumovtoFields = [])
    {
        /** @var inmumovtoRepository $inmumovtoRepo */
        $inmumovtoRepo = App::make(inmumovtoRepository::class);
        $theme = $this->fakeinmumovtoData($inmumovtoFields);
        return $inmumovtoRepo->create($theme);
    }

    /**
     * Get fake instance of inmumovto
     *
     * @param array $inmumovtoFields
     * @return inmumovto
     */
    public function fakeinmumovto($inmumovtoFields = [])
    {
        return new inmumovto($this->fakeinmumovtoData($inmumovtoFields));
    }

    /**
     * Get fake data of inmumovto
     *
     * @param array $postFields
     * @return array
     */
    public function fakeinmumovtoData($inmumovtoFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'inmucharg_id' => $fake->randomDigitNotNull,
            'unidmovto_id' => $fake->randomDigitNotNull,
            'catmovto_cve' => $fake->randomDigitNotNull,
            'date' => $fake->word,
            'folio' => $fake->word,
            'quantity' => $fake->word,
            'measureunit_id' => $fake->randomDigitNotNull,
            'amount' => $fake->word,
            'balance' => $fake->word,
            'status' => $fake->word,
            'apmode' => $fake->word,
            'description' => $fake->word,
            'observ' => $fake->word,
            'filelink' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word,
            'deleted_at' => $fake->word
        ], $inmumovtoFields);
    }
}
