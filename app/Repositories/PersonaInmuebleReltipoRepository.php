<?php

namespace App\Repositories;

use App\Models\PersonaInmuebleReltipo;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonaInmuebleReltipoRepository
 * @package App\Repositories
 * @version April 20, 2018, 11:26 pm UTC
 *
 * @method PersonaInmuebleReltipo findWithoutFail($id, $columns = ['*'])
 * @method PersonaInmuebleReltipo find($id, $columns = ['*'])
 * @method PersonaInmuebleReltipo first($columns = ['*'])
*/
class PersonaInmuebleReltipoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'ident',
        'nombre',
        'descripcion'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonaInmuebleReltipo::class;
    }

    //================================================
    // Funcion creada por JB para listar tipos de relacion persona inmueble desde un SP
    public function gpersinmreltipos_sp()  
    {   
        // BEGIN
        // SELECT
        // persona_inmueble_reltipos.id,
        // persona_inmueble_reltipos.nombre
        // FROM
        // persona_inmueble_reltipos
        // ORDER BY
        // persona_inmueble_reltipos.nombre ASC;
        // END        
        return \DB::select('call sp_cPersInmRelTipos');        
    }
 //================================================
    // Funcion creada por JB para listar tipos de relacion persona inmueble desde un SP
    public function gpersinmreltipos()  
    {  
        return 
        PersonaInmuebleReltipo::               
        select(      
        'persona_inmueble_reltipos.id',
        'persona_inmueble_reltipos.nombre'
        )
        ->orderBy('persona_inmueble_reltipos.nombre','ASC')  
        ->get()//->toarray()
        ;          
    }  
 
}
