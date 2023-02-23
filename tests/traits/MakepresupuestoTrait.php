<?php

use Faker\Factory as Faker;
use App\Models\presupuesto;
use App\Repositories\presupuestoRepository;

trait MakepresupuestoTrait
{
    /**
     * Create fake instance of presupuesto and save it in database
     *
     * @param array $presupuestoFields
     * @return presupuesto
     */
    public function makepresupuesto($presupuestoFields = [])
    {
        /** @var presupuestoRepository $presupuestoRepo */
        $presupuestoRepo = App::make(presupuestoRepository::class);
        $theme = $this->fakepresupuestoData($presupuestoFields);
        return $presupuestoRepo->create($theme);
    }

    /**
     * Get fake instance of presupuesto
     *
     * @param array $presupuestoFields
     * @return presupuesto
     */
    public function fakepresupuesto($presupuestoFields = [])
    {
        return new presupuesto($this->fakepresupuestoData($presupuestoFields));
    }

    /**
     * Get fake data of presupuesto
     *
     * @param array $postFields
     * @return array
     */
    public function fakepresupuestoData($presupuestoFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'inmueble_id' => $fake->randomDigitNotNull,
            'movtipo_id' => $fake->randomDigitNotNull,
            'monto' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $presupuestoFields);
    }
}
