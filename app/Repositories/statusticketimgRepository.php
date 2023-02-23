<?php

namespace App\Repositories;

use App\Models\statusticketimg;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class statusticketimgRepository
 * @package App\Repositories
 * @version July 28, 2018, 3:33 am UTC
 *
 * @method statusticketimg findWithoutFail($id, $columns = ['*'])
 * @method statusticketimg find($id, $columns = ['*'])
 * @method statusticketimg first($columns = ['*'])
*/
class statusticketimgRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'filename',
        'link',
        'observations'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return statusticketimg::class;
    }
}
