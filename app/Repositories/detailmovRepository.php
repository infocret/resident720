<?php

namespace App\Repositories;

use App\Models\detailmov;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class detailmovRepository
 * @package App\Repositories
 * @version June 20, 2018, 6:45 am UTC
 *
 * @method detailmov findWithoutFail($id, $columns = ['*'])
 * @method detailmov find($id, $columns = ['*'])
 * @method detailmov first($columns = ['*'])
*/
class detailmovRepository extends BaseRepository
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
        return detailmov::class;
    }
//*******************************************************************************
    //Inserta los etalles recibe en un arreglo o matriz  (array)
    //Se utiliza desde el controlador de  inmumovimientoController 
    //para insertar todos los detalles    
    public function insertdetails(array $details)  
    {   
      // con el array inserta esos registros
      return detailmov::insert($details); 
    }   
//*******************************************************************************
     //Elimina las relaciones cuyo id  recibe en un arreglo o matriz  (array)
    //Se utiliza desde el controlador de inmumovimiento para borrar todos los detalles
    //de una cabecera de movimiento
    public function deletedetails(array $ids)  
    {   

      // Realiza una consulta donde los ids 
      // sean o esten en el array recibido y los elimina
      // Funciona ok pero creo es mas eficiente la otra
      //return categorieProviders::whereIn('id', $ids)->delete();
      
      // con el array de ids de la tabla elimina esos registros
      return detailmov::destroy($ids);
       
    }
    //================================================
    // Funcion creada por JB para listar  tipos de movimientos para llenado de select
    public function gTiposMovimiento($tipo)  
    {   
        //dd($tipo);
        $cTmovtos =  \DB::select('call sp_cTiposMovimiento(?)',array($tipo));
        if (!empty($cTmovtos)) {
            $Tmovtos;  // variable para regresar array asociativo
            // Ciclo que barre array original y crea array asociativo
            foreach($cTmovtos as $Tmovto){                   
                $Tmovtos[ $Tmovto->cve] = $Tmovto->nombre;                                  
            }
        }
        else{
             $Tmovtos["0"] = "Sin datos";   
        }

        return $Tmovtos;        
    }         
}
