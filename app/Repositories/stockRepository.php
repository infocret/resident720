<?php

namespace App\Repositories;

use App\Models\stock;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class stockRepository
 * @package App\Repositories
 * @version July 28, 2018, 4:14 am UTC
 *
 * @method stock findWithoutFail($id, $columns = ['*'])
 * @method stock find($id, $columns = ['*'])
 * @method stock first($columns = ['*'])
*/
class stockRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'stock',
        'location',
        'stock_max',
        'stock_min',
        'observations'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return stock::class;
    }
}
