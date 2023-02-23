<?php

namespace App\Repositories;

use App\Models\PersonaDir;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonaDirRepository
 * @package App\Repositories
 * @version February 16, 2018, 9:59 am UTC
 *
 * @method PersonaDir findWithoutFail($id, $columns = ['*'])
 * @method PersonaDir find($id, $columns = ['*'])
 * @method PersonaDir first($columns = ['*'])
*/
class PersonaDirRepository extends BaseRepository
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
        return PersonaDir::class;
    }
    
//================================================
   // Funcion creada por JB para listar ubicaciones (direcciones) de una persona para exportar a EXCELL
    public function gUbicacionesXLS($id)  // $id = persona_id
    {   
        return \DB::select('call sp_cPersonaUbicacionesXLS(?)', array($id));        
    }
    // Funcion creada por JB para listar ubicaciones (direcciones) de una persona
    public function gUbicaciones($id)  // $id = persona_id
    {   
        return \DB::select('call sp_cPersonaUbicaciones(?)', array($id));        
    }

    // Funcion creada por JB para mostrar UNA ubicacion (direccion) de una persona
    public function gUbicacion($id)  // $id = personadirs.id    
    {   
        //$ubicacion=PersonaDir::class;
        //$ubicacion =\DB::select('call sp_cPersonaUbicacion(?)',array($id));  
        //return  $ubicacion  ;  
        return \DB::select('call sp_cPersonaUbicacion(?)',array($id)); 
    }
        //================================================
    // Funcion creada por JB para listar tipos de medios (direcciones)
    public function gUbicacionesLista()  // $id = persona_id
    {   
        return \DB::select('call sp_cUbicacionesLista');        
    }    

     // Funcion creada por JB para listar ubicaciones (direcciones) de una persona
    public function gPubicaciones($persid)  // $id = persona_id
    {      
    return
    PersonaDir::
        join("cod_pos","persona_dirs.codpo_id","=","cod_pos.id")
        ->join("locations","persona_dirs.location_id","=","locations.id")
        ->where('persona_dirs.deleted_at',NULL) 
        ->where('persona_dirs.persona_id',$persid)
        //->orderBy('medios.nombre','ASC')                
        ->select(      
        'persona_dirs.id',
        'locations.nombre',
        'persona_dirs.calle',
        'persona_dirs.numExt', 
        'persona_dirs.numInt',
        'persona_dirs.piso',
        'cod_pos.tipo',
        'cod_pos.asentamiento',
        'cod_pos.municipio',
        'cod_pos.estado',
        'cod_pos.cp',
        'persona_dirs.linkmapa',
        'persona_dirs.imagenMapa'
        )
        ->get()
        //->toarray()
        ;        
    }    
}
