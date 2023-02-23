<?php

namespace App\Repositories;

use App\Models\movtobankaccount;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class movtobankaccountRepository
 * @package App\Repositories
 * @version July 27, 2018, 6:11 am UTC
 *
 * @method movtobankaccount findWithoutFail($id, $columns = ['*'])
 * @method movtobankaccount find($id, $columns = ['*'])
 * @method movtobankaccount first($columns = ['*'])
*/
class movtobankaccountRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nchbook_ntrx_ref',
        'owner',
        'amount',
        'observations',
        'Head_balance_Amount',
        'status'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return movtobankaccount::class;
    }
}
