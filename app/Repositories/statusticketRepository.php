<?php

namespace App\Repositories;

use App\Models\statusticket;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class statusticketRepository
 * @package App\Repositories
 * @version July 28, 2018, 2:21 am UTC
 *
 * @method statusticket findWithoutFail($id, $columns = ['*'])
 * @method statusticket find($id, $columns = ['*'])
 * @method statusticket first($columns = ['*'])
*/
class statusticketRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'status_date',
        'status',
        'observations'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return statusticket::class;
    }
}
