<?php

namespace App\Repositories;

use App\Models\anticiposapli;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class anticiposapliRepository
 * @package App\Repositories
 * @version April 11, 2022, 8:03 pm UTC
 *
 * @method anticiposapli findWithoutFail($id, $columns = ['*'])
 * @method anticiposapli find($id, $columns = ['*'])
 * @method anticiposapli first($columns = ['*'])
*/
class anticiposapliRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'fechareg',
        'saldoini',
        'monto',
        'saldofin',
        'status',
        'apmode',
        'desc',
        'observ',
        'userreg'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return anticiposapli::class;
    }
}
