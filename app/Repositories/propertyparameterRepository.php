<?php

namespace App\Repositories;

use App\Models\propertyparameter;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class propertyparameterRepository
 * @package App\Repositories
 * @version October 16, 2018, 1:54 am UTC
 *
 * @method propertyparameter findWithoutFail($id, $columns = ['*'])
 * @method propertyparameter find($id, $columns = ['*'])
 * @method propertyparameter first($columns = ['*'])
*/
class propertyparameterRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'parametro',
        'valor'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return propertyparameter::class;
    }

   // Funcion creada por JB para lista de indivisos de unidad
    public function gIndivisos($unidadid)  //$inmueble_id)
    {
        //dd($propid);
        return propertyparameter::distinct()     
        ->where('parametro','like','%ndivis%') 
        ->where('inmueble_id','=',$unidadid)   
        ->orderBy('id','ASC')->get();
        //->pluck('estado');    
    }

    // Funcion creada por JB para lista parametros de Condominio
    public function gParametros($unidadid)  //$inmueble_id)
    {
        //dd($propid);
        return propertyparameter::distinct()             
        ->where('inmueble_id','=',$unidadid)   
        ->orderBy('id','ASC')->get();
        //->pluck('estado');    
    }

    // Funcion creada por JB para lista parametros de Condominio con descripciones
    public function gParamDesc($unidadid)  //$inmueble_id)
    {
      return \DB::select('call sp_cParamsDesc(?)', array($unidadid));        
    }

    // Funcion creada por JB para listar informacion de un parametro 
    public function gParamInfo($pclave)  //$inmueble_id)
    {
     return \DB::select('call sp_cParamInfo(?)', array($pclave));            
    }


    // Funcion creada por JB para obtener un registro de parametro
    public function gParametro($condomi,$param)  //$inmueble_id)
    {        
        return propertyparameter::
        where('inmueble_id','=',$condomi)   
        ->where('parametro','=',$param)   
        //->orderBy('id','ASC')
        ->get();
        //->pluck('estado');    
    }

    //==========================================================================
    // Funcion creada por JB para obtener el valor de un parametro de inmueble
    // Condominio_id = inmueble_id, param= nombre del parametro
    // =========================================================================
        // SELECT
        // propertyparameters.valor as valorp
        // FROM
        // propertyparameters
        // WHERE
        // propertyparameters.parametro = param
        // AND
        // propertyparameters.inmueble_id= condomid;
    // =========================================================================
    public function gValParam($inmuid, $param)  
    {  
        $val = propertyparameter::  
        select(      
        'propertyparameters.valor as valorp'       
              )               
        ->where('propertyparameters.parametro',$param)
        ->where('propertyparameters.inmueble_id',$inmuid)        
        ->get();
        //->toarray()        
        
        //Si viene vacio el array
        if ($val->count()<1 ){
            $valorparam='0';
        }
        else{
            $valorparam = $val[0]->valorp;    //se toma el valor
        }
       
        if (empty($valorparam)){
        // Si viene vacio o nulo 
           $valorparam = '0';
        }
        
        return  $valorparam; 
    } 


    // Funcion creada por JB para lista de indivisos 
    // de TODAS las unidades de un condominio
    public function gAllIndivisos($condomid)  //$inmueble_id)
    {
         return \DB::select('call sp_cIndivisos(?)', array($condomid));     
    }

    //*******************************************************************************
    //Inserta recibe en un arreglo o matriz  (array)
    //Se utiliza desde el controlador de  expedpresupuestoController
    //para insertar parametro de Total de presupuesto
    public function insertaparam($cond, $para, $val)  
    {   
      // con el array inserta esos registros
      $param = new propertyparameter;
      $param ->inmueble_id = $cond;
      $param ->parametro =  $para;
      $param ->valor = $val;      
      $result = $param->save();      
      return $result;
      //return propertyparameter::insert($details); 
    }   

    //==========================================================================
    // Funcion creada por JB para obtener el valor de un parametro de inmueble
    // Condominio_id = inmueble_id, param= nombre del parametro
    // public function gValParam_sp($inmuid, $param)  // Ya no se usa!
    // {   
    //     return \DB::select('call sp_cObtenValParam(?,?)', array($inmuid, $param));        
    // }    
}
