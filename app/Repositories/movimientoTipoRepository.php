<?php

namespace App\Repositories;

use App\Models\movimientoTipo;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class movimientoTipoRepository
 * @package App\Repositories
 * @version June 20, 2018, 3:33 am UTC
 *
 * @method movimientoTipo findWithoutFail($id, $columns = ['*'])
 * @method movimientoTipo find($id, $columns = ['*'])
 * @method movimientoTipo first($columns = ['*'])
*/
class movimientoTipoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'tipo',
        'cve',
        'nombre',
        'descripcion'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return movimientoTipo::class;
    }
}
