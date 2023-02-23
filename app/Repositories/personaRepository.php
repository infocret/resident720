<?php

namespace App\Repositories;

use App\Models\persona;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class personaRepository
 * @package App\Repositories
 * @version April 2, 2018, 3:15 am UTC
 *
 * @method persona findWithoutFail($id, $columns = ['*'])
 * @method persona find($id, $columns = ['*'])
 * @method persona first($columns = ['*'])
*/
class personaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name' => 'like',
        'appat' => 'like',
        'apmat' => 'like',
        'lugarnac' => 'like',
        'datebirth' => 'like',
        'genero' => 'like',
        'rfc' => 'like',
        'curp' => 'like',
        'nss' => 'like'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return persona::class;
    }

    // Funcion creada por JB para obtener a la persona que espropietaria de un inmueble
    public function gpropietario($inmuid)  // $inmuid = inmuebles.id - Id de inmueble
    {
        return
        persona::
        select(      
            'personas.id',
            'personas.name',
            'personas.appat',
            'personas.apmat',
            'personas.rfc',
            'persona_inmuebles.inmueble_id',
            'persona_inmuebles.reltipo_id',
            'persona_inmueble_reltipos.nombre',
            'persona_inmueble_reltipos.descripcion'            
            )          
         ->join("persona_inmuebles", "persona_inmuebles.persona_id", "=",
              "personas.id")         
         ->join("persona_inmueble_reltipos","persona_inmueble_reltipos.id","persona_inmuebles.reltipo_id")
         ->where( "persona_inmuebles.reltipo_id",1)   // Solo si esta relacionado como  propietario      
         ->where( "persona_inmuebles.inmueble_id",$inmuid)         
         ->orderBy("personas.id")              
         ->get()        
        ;        
    }    


    // Funcion creada por JB para obtener personas para rel proveedor
    public function gpersonas()  // $inmuid = inmuebles.id - Id de inmueble
    {
        return
        persona::
        select(      
            'personas.id',
            'personas.name',
            'personas.appat',
            'personas.apmat',
            'personas.rfc'           
            )               
         ->orderBy("personas.appat")              
         ->get()// ->toarray()       
        ;        
    }        
//================================================
    // Funcion creada por JB para listar ubicaciones (direcciones)
    // public function gUbicaciones($id)  // $id = persona_id
    // {   
    //     return \DB::select('call sp_cPersonaUbicaniones(?)', array($id));        
    // }
}
