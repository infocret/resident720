<?php

namespace App\Repositories;

use App\Models\event;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class eventRepository
 * @package App\Repositories
 * @version August 4, 2018, 6:52 am UTC
 *
 * @method event findWithoutFail($id, $columns = ['*'])
 * @method event find($id, $columns = ['*'])
 * @method event first($columns = ['*'])
*/
class eventRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'start_date',
        'end_date'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return event::class;
    }
}
