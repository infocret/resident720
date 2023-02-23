<?php

namespace App\Repositories;

use App\Models\inmueble;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class inmuebleRepository
 * @package App\Repositories
 * @version February 16, 2018, 8:24 am UTC
 *
 * @method inmueble findWithoutFail($id, $columns = ['*'])
 * @method inmueble find($id, $columns = ['*'])
 * @method inmueble first($columns = ['*'])
*/
class condominioRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'ident',
        'nombre',
        'descripcion'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return inmueble::class;
    }
}
