<?php

namespace App\Repositories;

use App\Models\period;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class periodRepository
 * @package App\Repositories
 * @version July 28, 2018, 6:05 am UTC
 *
 * @method period findWithoutFail($id, $columns = ['*'])
 * @method period find($id, $columns = ['*'])
 * @method period first($columns = ['*'])
*/
class periodRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'cve',
        'shortname',
        'name',
        'start_date',
        'final_date',
        'recurrence',
        'interval',
        'unit_time',
        'business_days',
        'sub_add_day',
        'code',
        'observations'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return period::class;
    }
}
