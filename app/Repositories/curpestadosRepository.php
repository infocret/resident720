<?php

namespace App\Repositories;

use App\Models\curpestados;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class curpestadosRepository
 * @package App\Repositories
 * @version April 4, 2018, 12:34 am UTC
 *
 * @method curpestados findWithoutFail($id, $columns = ['*'])
 * @method curpestados find($id, $columns = ['*'])
 * @method curpestados first($columns = ['*'])
*/
class curpestadosRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'estado',
        'renapo',
        'abrev',
        'dosdig',
        'iso'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return curpestados::class;
    }
    // Funcion creada por JB para lista de estados en select (lista desplegable)
    public function gcurpEstados()  //$cp,$ciudad)
    {
        return curpestados::distinct()     
        ->where('estado','<>','')   
        ->orderBy('estado','ASC')
        ->pluck('estado','renapo');    
    }
}
