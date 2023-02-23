<?php

use Faker\Factory as Faker;
use App\Models\movtodetail;
use App\Repositories\movtodetailRepository;

trait MakemovtodetailTrait
{
    /**
     * Create fake instance of movtodetail and save it in database
     *
     * @param array $movtodetailFields
     * @return movtodetail
     */
    public function makemovtodetail($movtodetailFields = [])
    {
        /** @var movtodetailRepository $movtodetailRepo */
        $movtodetailRepo = App::make(movtodetailRepository::class);
        $theme = $this->fakemovtodetailData($movtodetailFields);
        return $movtodetailRepo->create($theme);
    }

    /**
     * Get fake instance of movtodetail
     *
     * @param array $movtodetailFields
     * @return movtodetail
     */
    public function fakemovtodetail($movtodetailFields = [])
    {
        return new movtodetail($this->fakemovtodetailData($movtodetailFields));
    }

    /**
     * Get fake data of movtodetail
     *
     * @param array $postFields
     * @return array
     */
    public function fakemovtodetailData($movtodetailFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'movtohead_id' => $fake->randomDigitNotNull,
            'movimientotipo_id' => $fake->randomDigitNotNull,
            'cantidad' => $fake->randomDigitNotNull,
            'unidad' => $fake->word,
            'descripcion' => $fake->word,
            'preciounit' => $fake->word,
            'subtot' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $movtodetailFields);
    }
}
