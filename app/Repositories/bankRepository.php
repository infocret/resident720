<?php

namespace App\Repositories;

use App\Models\bank;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class bankRepository
 * @package App\Repositories
 * @version July 26, 2018, 10:26 pm UTC
 *
 * @method bank findWithoutFail($id, $columns = ['*'])
 * @method bank find($id, $columns = ['*'])
 * @method bank first($columns = ['*'])
*/
class bankRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'cve',
        'ident',
        'shortname',
        'fullname',
        'participates',
        'website'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return bank::class;
    }

    // Funcion creada por JB para lista bancos (lista desplegable)
    public function gBancos()  //
    {   
      return bank::orderBy('shortname','ASC')->pluck('shortname','id');        
    }
}
