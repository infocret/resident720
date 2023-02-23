<?php

namespace App\Repositories;

use App\Models\PersonaInmueble;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonaInmuebleRepository
 * @package App\Repositories
 * @version April 20, 2018, 10:33 pm UTC
 *
 * @method PersonaInmueble findWithoutFail($id, $columns = ['*'])
 * @method PersonaInmueble find($id, $columns = ['*'])
 * @method PersonaInmueble first($columns = ['*'])
*/
class PersonaInmuebleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'asignacion',
        'baja',
        'observaciones'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonaInmueble::class;
    }
    //================================================
    // Funcion creada por JB para listar  relaciones a inmuebles de una persona
    public function gRelPersInmu($personaexpid,$relid)  
    {   
        return \DB::select('call sp_cRelPersInmu(?,?)', array($personaexpid,$relid));        
    }
       //================================================
    // Funcion creada por JB para listar  inmuebles y agregar relacion con persona
    public function gInmuLista($opcion)  
    {   
        return \DB::select('call sp_cInmueblesLista(?)',array($opcion));        
    }

   //================================================
   // Funcion creada por JB para listar personas asignadas a un inmueble
    public function gPersonas($id)  // $id = inmueble_id
    {      
        return \DB::select('call sp_cPersonasAsigCondom(?)', array($id)); 
    }    
    //================================================   
   // Funcion creada por JB para listar personas que NO estan asignadas a un inmueble
    public function gPersonasno($id)  // $id = inmueble_id
    {      
        return \DB::select('call sp_cPersonaNoAsignadaInmu(?)', array($id)); 
    } 
    //================================================   
    // Funcion creada por JB para consultar miembros del comite
    public function gConomite($id)  // $id = inmueble_id
    {      
        return \DB::select('call sp_cComite (?)', array($id)); 
    }
    //================================================       
   // Funcion creada por JB para guardar nueva personas, correo, telefono
   // e insertar relacion a inmueble
    public function savePersonRelProperty($paramarray)  // $id = inmueble_id
    {      
        return \DB::select('call sp_iPersonRelProperty(?,?,?,?,?,?,?,?)', $paramarray); 
    }
    //================================================     
// Funcion creada por JB para listar unidades que pertenecen a un condominio
// OJO: Carbon marca error !!!!!
    public function gPersonasB($inmuid)  // $id = inmueble_id
    {
        $personmedio =
        PersonaInmueble::  
        join("personas","persona_inmuebles.persona_id","=","personas.id")            
        ->join("persona_inmueble_reltipos","persona_inmuebles.reltipo_id","=",
            "persona_inmueble_reltipos.id") 
        ->join("medio_personas","medio_personas.persona_id","=","personas.id")
        ->where('persona_inmuebles.reltipo_id','<>',5)
        ->where('persona_inmuebles.inmueble_id',$inmuid)
        ->where('medio_personas.medio_id',2) 
        //->orderBy('inmuebles.id','ASC')                
        ->select(      
        'persona_inmuebles.id as relid',
        'persona_inmueble_reltipos.nombre as asignacion',
        'personas.name as nombre',
        'personas.appat as paterno',
        'personas.apmat as materno',
        'medio_personas.dato as telefono',
        'persona_inmuebles.asignacion as desde',
        'personas.id as personaid',
        'persona_inmuebles.reltipo_id as reltipoid',
        'persona_inmuebles.observaciones',
        'persona_inmueble_reltipos.descripcion',
        'persona_inmueble_reltipos.ident',
        'persona_inmuebles.inmueble_id' 
        )
        //->get()
        //->toarray()
        ;   
            //dd($personmedio);

        $pArray=\DB::select("Select persona_id from medio_personas WHERE
                            medio_personas.medio_id = ?",[2]);
            //dd($pArray);

        $pids = array();
        foreach ($pArray as  $person) {            
            // Anexa el registro a el arreglo de registros
            array_push($pids,$person->persona_id);           
         }         
            //dd($pids);
           
        $raw =  \DB::raw('"N/A" as telefono');

        $personSINmedio =
        PersonaInmueble::  
        join("personas","persona_inmuebles.persona_id","=","personas.id")            
        ->join("persona_inmueble_reltipos","persona_inmuebles.reltipo_id","=",
            "persona_inmueble_reltipos.id") 
        //->join("medio_personas","medio_personas.persona_id","=","personas.id")
        ->where('persona_inmuebles.reltipo_id','<>',5)
        ->where('persona_inmuebles.inmueble_id',$inmuid)
        //->where('medio_personas.medio_id',2) 
        ->whereNotIn('personas.id',$pids)
        //->orderBy('inmuebles.id','ASC')                
        ->select(      
        'persona_inmuebles.id as relid',
        'persona_inmueble_reltipos.nombre as asignacion',
        'personas.name as nombre',
        'personas.appat as paterno',
        'personas.apmat as materno',
        $raw,
        'persona_inmuebles.asignacion as desde',
        'personas.id as personaid',
        'persona_inmuebles.reltipo_id as reltipoid',
        'persona_inmuebles.observaciones',
        'persona_inmueble_reltipos.descripcion',
        'persona_inmueble_reltipos.ident',
        'persona_inmuebles.inmueble_id' 
        )
        //->get()
        //->toarray()
        ;   

        //dd($personSINmedio);

        $results = $personmedio->union($personSINmedio)->get()->tojson();
        dd($results);

        return $results;
    }   

//============== se movio  a PersonaInmuebleReltipoRepository  ==============================
    // Funcion creada por JB para listar tipos de relacion persona inmueble desde un SP
    // public function gpersinmreltipos_sp()  
    // {  
    //  return \DB::select('call sp_cPersInmRelTipos');        
    // }
    
  
}
