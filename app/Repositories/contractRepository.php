<?php

namespace App\Repositories;

use App\Models\contract;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class contractRepository
 * @package App\Repositories
 * @version July 28, 2018, 4:30 am UTC
 *
 * @method contract findWithoutFail($id, $columns = ['*'])
 * @method contract find($id, $columns = ['*'])
 * @method contract first($columns = ['*'])
*/
class contractRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'cve',
        'shortname',
        'name',
        'descripcion',
        'content',
        'privileges',
        'obligations',
        'observations'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return contract::class;
    }
}
