<?php

namespace App\Repositories;

use App\Models\MedioPersona;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class MedioPersonaRepository
 * @package App\Repositories
 * @version February 16, 2018, 9:47 am UTC
 *
 * @method MedioPersona findWithoutFail($id, $columns = ['*'])
 * @method MedioPersona find($id, $columns = ['*'])
 * @method MedioPersona first($columns = ['*'])
*/
class MedioPersonaRepository extends BaseRepository
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
        return MedioPersona::class;
    }

    //================================================
    // Funcion creada por JB para listar medios de una persona (direcciones)
    public function gMedios($personaexpid)  // $id = persona_id
    {   
        return \DB::select('call sp_cPersonaMedios(?)', array($personaexpid));        
    }
        //================================================
    // Funcion creada por JB para listar tipos de medios (direcciones)
    public function gMediosLista()  // $id = persona_id
    {   
        return \DB::select('call sp_cMediosLista');        
    }


  //================================================
    // Funcion creada por JB para listar medios de una persona (direcciones)
    public function gpMedios($personaexpid)  // $id = persona_id
    {
    $meds =
    MedioPersona::select(
    'medio_personas.id',
    'medios.imgfilename',
    'medios.descripcion',
    'medios.nombre',
    'medio_personas.dato',
    'medio_personas.observaciones'
    )
    ->join("medios","medio_personas.medio_id","=","medios.id")  
    ->where('medio_personas.persona_id',$personaexpid)       
    ->orderby('medio_personas.id')
    ->get();
   
    return $meds;        
    }


}

