<?php

namespace App\Repositories;

use App\Models\service;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class serviceRepository
 * @package App\Repositories
 * @version June 5, 2018, 5:06 am UTC
 *
 * @method service findWithoutFail($id, $columns = ['*'])
 * @method service find($id, $columns = ['*'])
 * @method service first($columns = ['*'])
*/
class serviceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nomcorto',
        'nombre',
        'descripcion'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return service::class;
    }
}
