<?php

namespace App\Repositories;

use App\Models\parameter;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class parameterRepository
 * @package App\Repositories
 * @version December 20, 2018, 9:05 pm UTC
 *
 * @method parameter findWithoutFail($id, $columns = ['*'])
 * @method parameter find($id, $columns = ['*'])
 * @method parameter first($columns = ['*'])
*/
class parameterRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'clave',
        'descripcion',
        'tipo',
        'default',
        'observaciones'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return parameter::class;
    }
}
