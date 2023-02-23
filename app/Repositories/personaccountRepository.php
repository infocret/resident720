<?php

namespace App\Repositories;

use App\Models\personaccount;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class personaccountRepository
 * @package App\Repositories
 * @version July 26, 2018, 11:16 pm UTC
 *
 * @method personaccount findWithoutFail($id, $columns = ['*'])
 * @method personaccount find($id, $columns = ['*'])
 * @method personaccount first($columns = ['*'])
*/
class personaccountRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return personaccount::class;
    }
}
