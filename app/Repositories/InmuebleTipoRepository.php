<?php

namespace App\Repositories;

use App\Models\InmuebleTipo;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class InmuebleTipoRepository
 * @package App\Repositories
 * @version February 16, 2018, 8:22 am UTC
 *
 * @method InmuebleTipo findWithoutFail($id, $columns = ['*'])
 * @method InmuebleTipo find($id, $columns = ['*'])
 * @method InmuebleTipo first($columns = ['*'])
*/
class InmuebleTipoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'ident',
        'nombre',
        'descripcion',
        'imgfilename'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return InmuebleTipo::class;
    }
    //================================================
   // Funcion creada por JB para listar tipos de inmuebles diferentes de condominio
    public function gInmuebleTipos_sp($tipoid)  // $tipoid = tipo_id = 1 = condominio
    {   
        // BEGIN
        //     SELECT
        // inmueble_tipos.id,
        // inmueble_tipos.ident,
        // inmueble_tipos.nombre,
        // inmueble_tipos.descripcion
        // FROM
        // inmueble_tipos
        // WHERE
        // inmueble_tipos.id > tipoinmu;
        // END        
        return \DB::select('call sp_cInmuebleTipos(?)', array($tipoid));        
    }
             //================================================
   // Funcion creada por JB para listar tipos de inmuebles diferentes de condominio
    public function gInmuebleTipos($tipoid)  // $tipoid = tipo_id = 1 = condominio
    {   
    return 
        InmuebleTipo::
        select(      
        'inmueble_tipos.id',
        'inmueble_tipos.ident',
        'inmueble_tipos.nombre',
        'inmueble_tipos.descripcion'    
        )
        ->where('inmueble_tipos.id','>',$tipoid) 
        ->orderBy('inmueble_tipos.id','ASC') 
        ->get()//->toarray()
        ;              
    }        
}
