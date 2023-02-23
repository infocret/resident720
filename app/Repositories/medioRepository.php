<?php

namespace App\Repositories;

use App\Models\medio;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class medioRepository
 * @package App\Repositories
 * @version February 16, 2018, 9:47 am UTC
 *
 * @method medio findWithoutFail($id, $columns = ['*'])
 * @method medio find($id, $columns = ['*'])
 * @method medio first($columns = ['*'])
*/
class medioRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'ident',
        'nombre',
        'descripcion',
        'mask',
        'imgfilename'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return medio::class;
    }
    //================================================
    // Funcion creada por JB para listar tipos de medios 
    public function gMediosLista_sp()  // $id = persona_id
    {   
        // BEGIN
        // SELECT
        // medios.id,
        // medios.nombre       
        // FROM
        // medios
        // ORDER BY
        // medios.nombre ASC;
        // END
        return \DB::select('call sp_cMediosLista');        
    }
    //================================================
   // Funcion creada por JB para listar tipos de medios 
    public function gMediosLista()  // $id = inmueble_id
    {   
        return 
        medio::      
        orderBy('medios.nombre','ASC')                
        ->select(      
        'medios.id',
        'medios.nombre' 
        )
        ->get()
        //->toarray()
        ;        
    }    
}
