<?php

namespace App\Repositories;

use App\Models\activitytracking;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class activitytrackingRepository
 * @package App\Repositories
 * @version July 27, 2018, 6:22 am UTC
 *
 * @method activitytracking findWithoutFail($id, $columns = ['*'])
 * @method activitytracking find($id, $columns = ['*'])
 * @method activitytracking first($columns = ['*'])
*/
class activitytrackingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'act_type',
        'activity_date',
        'status_applied',
        'observations'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return activitytracking::class;
    }
}
