<?php

namespace App\Repositories;

use App\Models\articlescategorie;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class articlescategorieRepository
 * @package App\Repositories
 * @version July 28, 2018, 4:06 am UTC
 *
 * @method articlescategorie findWithoutFail($id, $columns = ['*'])
 * @method articlescategorie find($id, $columns = ['*'])
 * @method articlescategorie first($columns = ['*'])
*/
class articlescategorieRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'cve',
        'shortname',
        'name',
        'description',
        'observations'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return articlescategorie::class;
    }
}
