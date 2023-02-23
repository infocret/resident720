<?php

namespace App\Repositories;

use App\Models\stockmovement;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class stockmovementRepository
 * @package App\Repositories
 * @version July 28, 2018, 4:23 am UTC
 *
 * @method stockmovement findWithoutFail($id, $columns = ['*'])
 * @method stockmovement find($id, $columns = ['*'])
 * @method stockmovement first($columns = ['*'])
*/
class stockmovementRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'reference',
        'date',
        'quantity',
        'mov_type',
        'observations'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return stockmovement::class;
    }
}
