<?php

namespace App\Repositories;

use App\Models\checkbook;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class checkbookRepository
 * @package App\Repositories
 * @version July 26, 2018, 11:01 pm UTC
 *
 * @method checkbook findWithoutFail($id, $columns = ['*'])
 * @method checkbook find($id, $columns = ['*'])
 * @method checkbook first($columns = ['*'])
*/
class checkbookRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'shortname',
        'fullname',
        'description',
        'start',
        'end'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return checkbook::class;
    }

    // Funcion creada por JB para lista de chequeras (lista desplegable)
    public function gCheckbooks($bankaccount)  // bankaccount_id
    {
        return checkbook::distinct()     
        ->where('bankaccount_id',$bankaccount)   
        ->orderBy('fullname','ASC')
        ->pluck('fullname','id')->toarray();    
    }

    // Funcion creada por JB para lista de chequeras (show de banckaccounts)
    public function gAccountCheckbooks($bankaccount)  // bankaccount_id
    {
        return checkbook::select(
        'id',
        'shortname',
        'fullname',
        'description',
        'start',
        'end')     
        ->where('bankaccount_id',$bankaccount)   
        ->orderBy('fullname','ASC')
        ->get();
        //->pluck('fullname','id')->toarray();    
    }

}
