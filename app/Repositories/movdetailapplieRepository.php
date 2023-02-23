<?php

namespace App\Repositories;

use App\Models\movdetailapplie;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class movdetailapplieRepository
 * @package App\Repositories
 * @version July 27, 2018, 6:17 am UTC
 *
 * @method movdetailapplie findWithoutFail($id, $columns = ['*'])
 * @method movdetailapplie find($id, $columns = ['*'])
 * @method movdetailapplie first($columns = ['*'])
*/
class movdetailapplieRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'applie_date',
        'amount_applied',
        'detail_balance_amount'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return movdetailapplie::class;
    }
}
