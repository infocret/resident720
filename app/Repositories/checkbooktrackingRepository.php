<?php

namespace App\Repositories;

use App\Models\checkbooktracking;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class checkbooktrackingRepository
 * @package App\Repositories
 * @version March 27, 2020, 2:10 am UTC
 *
 * @method checkbooktracking findWithoutFail($id, $columns = ['*'])
 * @method checkbooktracking find($id, $columns = ['*'])
 * @method checkbooktracking first($columns = ['*'])
*/
class checkbooktrackingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datereg',
        'status',
        'observ'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return checkbooktracking::class;
    }
}
