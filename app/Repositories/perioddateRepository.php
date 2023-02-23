<?php

namespace App\Repositories;

use App\Models\perioddate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class perioddateRepository
 * @package App\Repositories
 * @version July 28, 2018, 6:13 am UTC
 *
 * @method perioddate findWithoutFail($id, $columns = ['*'])
 * @method perioddate find($id, $columns = ['*'])
 * @method perioddate first($columns = ['*'])
*/
class perioddateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'date',
        'yearday',
        'action',
        'status',
        'observations'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return perioddate::class;
    }
}
