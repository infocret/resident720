<?php

namespace App\Repositories;

use App\Models\InmuebleMedio;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class InmuebleMedioRepository
 * @package App\Repositories
 * @version May 2, 2018, 10:45 pm UTC
 *
 * @method InmuebleMedio findWithoutFail($id, $columns = ['*'])
 * @method InmuebleMedio find($id, $columns = ['*'])
 * @method InmuebleMedio first($columns = ['*'])
*/
class InmuebleMedioRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'dato',
        'observaciones'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return InmuebleMedio::class;
    }

      //================================================
    // Funcion creada por JB para listar medios de un inmu 
    public function gMedios_sp($propertyexpid)  // $id = persona_id
    {   
        // BEGIN
        // SELECT
        // inmueble_medios.id,
        // inmueble_medios.dato,
        // inmueble_medios.observaciones,
        // medios.imgfilename,
        // medios.descripcion,
        // medios.nombre
        // FROM
        // medios
        // INNER JOIN inmueble_medios ON inmueble_medios.medio_id = medios.id
        // WHERE
        // inmueble_medios.deleted_at IS NULL
        // AND inmueble_medios.inmueble_id = inmueble_id
        // ORDER BY
        // medios.nombre;
        // END
        return \DB::select('call sp_cInmuMedios(?)', array($propertyexpid));        
    }
    

    //================================================
   // Funcion creada por JB para listar medios de un inmueble
    public function gMedios($inmuid)  // $id = inmueble_id
    {   
        return 
        InmuebleMedio::
        join("medios","medios.id","=","inmueble_medios.medio_id")
        ->where('inmueble_medios.deleted_at',NULL) 
        ->where('inmueble_medios.inmueble_id',$inmuid)
        ->orderBy('medios.nombre','ASC')                
        ->select(      
        'inmueble_medios.id',
        'inmueble_medios.dato',
        'inmueble_medios.observaciones',
        'medios.imgfilename',
        'medios.descripcion',
        'medios.nombre'
        )
        ->get()
        //->toarray()
        ;        
    }     
                         
//======================= Se movieron a medioRepository   ==================
    // Funcion creada por JB para listar tipos de medios 
    // public function gMediosLista_sp()  // $id = persona_id
    // { 
        // BEGIN
        // SELECT
        // medios.id,
        // medios.nombre       
        // FROM
        // medios
        // ORDER BY
        // medios.nombre ASC;
        // END
    //     return \DB::select('call sp_cMediosLista');        
    // }
    //================================================
   // Funcion creada por JB para listar tipos de medios 
    // public function gMediosLista($inmuid)  // $id = inmueble_id
    // {   
    //     return 
    //     medio::      
    //     orderBy('medios.nombre','ASC')                
    //     ->select(      
    //     'medios.id',
    //     'medios.nombre' 
    //     )
    //     ->get()
    //     //->toarray()
    //     ;        
    // }                             
}
