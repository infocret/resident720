<?php

namespace App\Repositories;

use App\Models\InmuebleDir;
use InfyOm\Generator\Common\BaseRepository;
//use DB;                         // para el DB raw

/**
 * Class InmuebleDirRepository
 * @package App\Repositories
 * @version May 2, 2018, 10:42 pm UTC
 *
 * @method InmuebleDir findWithoutFail($id, $columns = ['*'])
 * @method InmuebleDir find($id, $columns = ['*'])
 * @method InmuebleDir first($columns = ['*'])
*/
class InmuebleDirRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'pais',
        'calle',
        'numExt',
        'piso',
        'numInt',
        'referencia1',
        'referencia2',
        'linkmapa',
        'imagenMapa',
        'observaciones'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return InmuebleDir::class;
    }
   //================================================
   // Funcion creada por JB para listar ubicaciones (direcciones) de un inmueble para exportar a EXCELL
    public function gUbicacionesXLS($id)  // $id = inmueble_id
    {   
        return \DB::select('call sp_cInmuebleUbicacionesXLS(?)', array($id));        
    }
   // Funcion creada por JB para mostrar UNA ubicacion (direccion) de un inmueble
    public function gUbicacion($id)  // $id = inmueble_dirs.id  
    {   
        //$ubicacion=PersonaDir::class;
        //$ubicacion =\DB::select('call sp_cInmuebleUbicacion(?)',array($id));  
        //return  $ubicacion  ;  
        return \DB::select('call sp_cInmuebleUbicacion(?)',array($id)); 
    }
        //================================================
    // Funcion creada por JB para listar tipos de ubcaciones (direcciones)
    public function gUbicacionesLista()  // $id = inmueble_id
    {   
        return \DB::select('call sp_cUbicacionesLista');        
    }  
    // Funcion creada por JB para listar ubicaciones (direcciones) de un inmueble
    public function gUbicaciones_sp($id)  // $id = inmueble_id
    {   
        // BEGIN
        // SELECT
        // inmueble_dirs.id,
        // locations.nombre,
        // concat (
        // inmueble_dirs.calle,
        // ' Num. ',inmueble_dirs.numExt, 
        // ' Int. ',inmueble_dirs.numInt,
        // ' Piso ',inmueble_dirs.piso,
        // ' ',cod_pos.tipo,
        // ' ',cod_pos.asentamiento,
        // ', ',cod_pos.municipio,
        // ', ',cod_pos.estado,
        // '. CP ',cod_pos.cp) as dir,
        // inmueble_dirs.linkmapa
        // FROM
        // inmueble_dirs
        // INNER JOIN cod_pos ON inmueble_dirs.codpo_id = cod_pos.id
        // INNER JOIN locations ON inmueble_dirs.location_id = locations.id
        // WHERE
        // inmueble_dirs.deleted_at IS NULL AND
        // inmueble_dirs.inmueble_id = inmueble_id;
        // END  
        return \DB::select('call sp_cInuebleUbicaciones(?)', array($id));        
    }

    // Funcion creada por JB para listar ubicaciones (direcciones) de un inmueble
    public function gUbicaciones_concat($inmuid)  // $id = inmueble_id
    {   
    $raw =  \DB::raw("concat (
        inmueble_dirs.calle,
        ' Num. ',inmueble_dirs.numExt, 
        ' Int. ',inmueble_dirs.numInt,
        ' Piso ',inmueble_dirs.piso,
        ' ',cod_pos.tipo,
        ' ',cod_pos.asentamiento,
        ', ',cod_pos.municipio,
        ', ',cod_pos.estado,
        '. CP ',cod_pos.cp) as dir");


    return
    InmuebleDir::
        join("cod_pos","inmueble_dirs.codpo_id","=","cod_pos.id")
        ->join("locations","inmueble_dirs.location_id","=","locations.id")
        ->where('inmueble_dirs.deleted_at',NULL) 
        ->where('inmueble_dirs.inmueble_id',$inmuid)
        //->orderBy('medios.nombre','ASC')                
        ->select(      
        'inmueble_dirs.id',
        'locations.nombre',
        $raw,
        'inmueble_dirs.linkmapa'
        )
        ->get()
        //->toarray()
        ;        
    }   
    // Funcion creada por JB para listar ubicaciones (direcciones) de un inmueble
    public function gUbicaciones($inmuid)  // $id = inmueble_id
    {      
    return
    InmuebleDir::
        join("cod_pos","inmueble_dirs.codpo_id","=","cod_pos.id")
        ->join("locations","inmueble_dirs.location_id","=","locations.id")
        ->where('inmueble_dirs.deleted_at',NULL) 
        ->where('inmueble_dirs.inmueble_id',$inmuid)
        //->orderBy('medios.nombre','ASC')                
        ->select(      
        'inmueble_dirs.id',
        'locations.nombre',
        'inmueble_dirs.calle',
        'inmueble_dirs.numExt', 
        'inmueble_dirs.numInt',
        'inmueble_dirs.piso',
        'cod_pos.tipo',
        'cod_pos.asentamiento',
        'cod_pos.municipio',
        'cod_pos.estado',
        'cod_pos.cp',
        'inmueble_dirs.linkmapa',
        'inmueble_dirs.imagenMapa'
        )
        ->get()
        //->toarray()
        ;        
    }    
}
