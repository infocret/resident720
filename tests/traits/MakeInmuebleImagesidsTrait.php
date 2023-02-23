<?php

use Faker\Factory as Faker;
use App\Models\InmuebleImagesids;
use App\Repositories\InmuebleImagesidsRepository;

trait MakeInmuebleImagesidsTrait
{
    /**
     * Create fake instance of InmuebleImagesids and save it in database
     *
     * @param array $inmuebleImagesidsFields
     * @return InmuebleImagesids
     */
    public function makeInmuebleImagesids($inmuebleImagesidsFields = [])
    {
        /** @var InmuebleImagesidsRepository $inmuebleImagesidsRepo */
        $inmuebleImagesidsRepo = App::make(InmuebleImagesidsRepository::class);
        $theme = $this->fakeInmuebleImagesidsData($inmuebleImagesidsFields);
        return $inmuebleImagesidsRepo->create($theme);
    }

    /**
     * Get fake instance of InmuebleImagesids
     *
     * @param array $inmuebleImagesidsFields
     * @return InmuebleImagesids
     */
    public function fakeInmuebleImagesids($inmuebleImagesidsFields = [])
    {
        return new InmuebleImagesids($this->fakeInmuebleImagesidsData($inmuebleImagesidsFields));
    }

    /**
     * Get fake data of InmuebleImagesids
     *
     * @param array $postFields
     * @return array
     */
    public function fakeInmuebleImagesidsData($inmuebleImagesidsFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'inmueble_id' => $fake->randomDigitNotNull,
            'link' => $fake->text,
            'filename' => $fake->word,
            'activ' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $inmuebleImagesidsFields);
    }
}
