<?php

namespace App\Repositories;

use App\Models\article;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class articleRepository
 * @package App\Repositories
 * @version July 28, 2018, 4:09 am UTC
 *
 * @method article findWithoutFail($id, $columns = ['*'])
 * @method article find($id, $columns = ['*'])
 * @method article first($columns = ['*'])
*/
class articleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'cve',
        'shortname',
        'name',
        'description',
        'measurement',
        'barcode',
        'observations'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return article::class;
    }
}
