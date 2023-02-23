<?php

namespace App\Repositories;

use App\Models\countries;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class countriesRepository
 * @package App\Repositories
 * @version March 19, 2018, 12:20 am UTC
 *
 * @method countries findWithoutFail($id, $columns = ['*'])
 * @method countries find($id, $columns = ['*'])
 * @method countries first($columns = ['*'])
*/
class countriesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'continente',
        'pais',
        'capital'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return countries::class;
    }

    // **************************************************************************************   
    // **************************************************************************************
 
 // Funcion creada por JB para lista de continentes en select (lista desplegable)
    public function gContinentes2()  //
    {   
       //return countries::distinct()->orderBy('continente','ASC')->get(['continente']);
        return countries::distinct()->orderBy('continente','ASC')->pluck('id','continente')->toarray();        
    }
    // Funcion creada por JB para lista de continentes en select (lista desplegable)
    public function gContinentes()  //
    {   
       //return countries::distinct()->orderBy('continente','ASC')->get(['continente']);
        return countries::distinct()->orderBy('continente','ASC')->pluck('continente');        
    }
   public function gContinente($pais)  //
    {   
       //return countries::distinct()->orderBy('continente','ASC')->get(['continente']);
        return countries::where('pais','=',$pais)->pluck('continente')->first();        
    }
    // Funcion creada por JB para lista de paises de un continente en select (lista desplegable)
    public function gPaises2($continente)  //
    {
        return countries::distinct()
        ->where('continente','like','%'.$continente.'%')
        ->where('pais','<>','')
        ->orderBy('pais','ASC')->pluck('pais','pais')->toarray();    
    }    
    // Funcion creada por JB para lista de paises de un continente en select (lista desplegable)
    public function gPaises($continente)  //
    {
        return countries::distinct()
        ->where('continente','like','%'.$continente.'%')
        ->where('pais','<>','')
        ->orderBy('pais','ASC')->pluck('pais','pais');    
    }
}
