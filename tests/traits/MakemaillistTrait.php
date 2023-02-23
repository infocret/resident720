<?php

use Faker\Factory as Faker;
use App\Models\maillist;
use App\Repositories\maillistRepository;

trait MakemaillistTrait
{
    /**
     * Create fake instance of maillist and save it in database
     *
     * @param array $maillistFields
     * @return maillist
     */
    public function makemaillist($maillistFields = [])
    {
        /** @var maillistRepository $maillistRepo */
        $maillistRepo = App::make(maillistRepository::class);
        $theme = $this->fakemaillistData($maillistFields);
        return $maillistRepo->create($theme);
    }

    /**
     * Get fake instance of maillist
     *
     * @param array $maillistFields
     * @return maillist
     */
    public function fakemaillist($maillistFields = [])
    {
        return new maillist($this->fakemaillistData($maillistFields));
    }

    /**
     * Get fake data of maillist
     *
     * @param array $postFields
     * @return array
     */
    public function fakemaillistData($maillistFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'inmueble_id' => $fake->randomDigitNotNull,
            'listtype' => $fake->word,
            'email' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $maillistFields);
    }
}
