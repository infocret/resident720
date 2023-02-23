<?php

namespace App\Repositories;

use App\Models\propertycontractservice;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class propertycontractserviceRepository
 * @package App\Repositories
 * @version July 28, 2018, 6:08 am UTC
 *
 * @method propertycontractservice findWithoutFail($id, $columns = ['*'])
 * @method propertycontractservice find($id, $columns = ['*'])
 * @method propertycontractservice first($columns = ['*'])
*/
class propertycontractserviceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'amount'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return propertycontractservice::class;
    }
}
