<?php

namespace App\Repositories;

use App\Models\movtodetail;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class movtodetailRepository
 * @package App\Repositories
 * @version July 27, 2018, 3:00 am UTC
 *
 * @method movtodetail findWithoutFail($id, $columns = ['*'])
 * @method movtodetail find($id, $columns = ['*'])
 * @method movtodetail first($columns = ['*'])
*/
class movtodetailRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'cantidad',
        'unidad',
        'descripcion',
        'preciounit',
        'subtot'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return movtodetail::class;
    }

    // Funcion creada por JB para listar detalles de un movimiento
    public function gDetails($headid)  // $id = movtohead.id - Id de cabecera
    {
        return
        movtodetail::
        select(      
            'movtodetails.id AS did',
            'movtodetails.cantidad AS dcant',
            'movtodetails.unidad As duni',
            'movimiento_tipos.cve AS dmtype',
            'movimiento_tipos.nombre AS dmname',
            'movtodetails.descripcion AS ddesc',
            'movtodetails.preciounit AS dpunit',
            'movtodetails.subtot AS dsubt'            
            )          
         ->join("movimiento_tipos", "movtodetails.movimientotipo_id", "=",
              "movimiento_tipos.id")         
         ->where( "movtodetails.movtohead_id",$headid)         
         ->orderBy("movtodetails.id")              
         ->get()        
        ;        
    }
}
