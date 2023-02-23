<?php

namespace App\Repositories;

use App\Models\ticket;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ticketRepository
 * @package App\Repositories
 * @version July 27, 2018, 10:19 pm UTC
 *
 * @method ticket findWithoutFail($id, $columns = ['*'])
 * @method ticket find($id, $columns = ['*'])
 * @method ticket first($columns = ['*'])
*/
class ticketRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'folio',
        'description'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ticket::class;
    }
}
