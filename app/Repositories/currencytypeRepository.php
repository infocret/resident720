<?php

namespace App\Repositories;

use App\Models\currencytype;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class currencytypeRepository
 * @package App\Repositories
 * @version July 26, 2018, 10:47 pm UTC
 *
 * @method currencytype findWithoutFail($id, $columns = ['*'])
 * @method currencytype find($id, $columns = ['*'])
 * @method currencytype first($columns = ['*'])
*/
class currencytypeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'territory',
        'currency',
        'symbol',
        'iso_code',
        'fractional_unit',
        'base_number'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return currencytype::class;
    }
}
