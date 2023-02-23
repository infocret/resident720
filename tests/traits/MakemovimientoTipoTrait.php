<?php

use Faker\Factory as Faker;
use App\Models\movimientoTipo;
use App\Repositories\movimientoTipoRepository;

trait MakemovimientoTipoTrait
{
    /**
     * Create fake instance of movimientoTipo and save it in database
     *
     * @param array $movimientoTipoFields
     * @return movimientoTipo
     */
    public function makemovimientoTipo($movimientoTipoFields = [])
    {
        /** @var movimientoTipoRepository $movimientoTipoRepo */
        $movimientoTipoRepo = App::make(movimientoTipoRepository::class);
        $theme = $this->fakemovimientoTipoData($movimientoTipoFields);
        return $movimientoTipoRepo->create($theme);
    }

    /**
     * Get fake instance of movimientoTipo
     *
     * @param array $movimientoTipoFields
     * @return movimientoTipo
     */
    public function fakemovimientoTipo($movimientoTipoFields = [])
    {
        return new movimientoTipo($this->fakemovimientoTipoData($movimientoTipoFields));
    }

    /**
     * Get fake data of movimientoTipo
     *
     * @param array $postFields
     * @return array
     */
    public function fakemovimientoTipoData($movimientoTipoFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'tipo' => $fake->word,
            'cve' => $fake->randomDigitNotNull,
            'nombre' => $fake->word,
            'descripcion' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $movimientoTipoFields);
    }
}
