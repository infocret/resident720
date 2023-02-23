<?php

namespace App\Repositories;

use App\Models\propertyservice;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class propertyserviceRepository
 * @package App\Repositories
 * @version July 28, 2018, 4:36 am UTC
 *
 * @method propertyservice findWithoutFail($id, $columns = ['*'])
 * @method propertyservice find($id, $columns = ['*'])
 * @method propertyservice first($columns = ['*'])
*/
class propertyserviceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'cve',
        'shortname',
        'name',
        'description',
        'content',
        'privileges',
        'obligations'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return propertyservice::class;
    }
}
