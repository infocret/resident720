<?php

namespace App\Repositories;

use App\Models\relationshipPropertie;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class relationshipPropertieRepository
 * @package App\Repositories
 * @version October 5, 2018, 4:23 am UTC
 *
 * @method relationshipPropertie findWithoutFail($id, $columns = ['*'])
 * @method relationshipPropertie find($id, $columns = ['*'])
 * @method relationshipPropertie first($columns = ['*'])
*/
class relationshipPropertieRepository extends BaseRepository
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
        return relationshipPropertie::class;
    }
}
