<?php

namespace App\Repositories;

use App\Models\provcats;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class provcatsRepository
 * @package App\Repositories
 * @version May 25, 2018, 7:27 pm UTC
 *
 * @method provcats findWithoutFail($id, $columns = ['*'])
 * @method provcats find($id, $columns = ['*'])
 * @method provcats first($columns = ['*'])
*/
class provcatsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'tipo',
        'categoria'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return provcats::class;
    }

 // Funcion creada por JB para buscar si existe categoria nueva
    public function existcat($tipo,$cat)  
    {
        //dd($tipo.'-'.$cat);
        return
        provcats::
        select(      
        'provcats.id',
        'provcats.tipo',
        'provcats.categoria'           
            )                
         ->where('provcats.tipo', '=', $tipo)
         ->where('provcats.categoria', '=', $cat)                           
         ->first()        
        ;        
    }


}
