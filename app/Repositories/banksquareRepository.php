<?php

namespace App\Repositories;

use App\Models\banksquare;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class banksquareRepository
 * @package App\Repositories
 * @version July 26, 2018, 10:32 pm UTC
 *
 * @method banksquare findWithoutFail($id, $columns = ['*'])
 * @method banksquare find($id, $columns = ['*'])
 * @method banksquare first($columns = ['*'])
*/
class banksquareRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'cve',
        'square'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return banksquare::class;
    }
}
