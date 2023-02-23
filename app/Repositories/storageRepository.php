<?php

namespace App\Repositories;

use App\Models\storage;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class storageRepository
 * @package App\Repositories
 * @version July 28, 2018, 3:48 am UTC
 *
 * @method storage findWithoutFail($id, $columns = ['*'])
 * @method storage find($id, $columns = ['*'])
 * @method storage first($columns = ['*'])
*/
class storageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'shortname',
        'name',
        'observations'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return storage::class;
    }
}
