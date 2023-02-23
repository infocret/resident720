<?php

namespace App\Repositories;

use App\Models\presupuesto;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class presupuestoRepository
 * @package App\Repositories
 * @version December 9, 2018, 8:09 am UTC
 *
 * @method presupuesto findWithoutFail($id, $columns = ['*'])
 * @method presupuesto find($id, $columns = ['*'])
 * @method presupuesto first($columns = ['*'])
*/
class presupuestoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'monto'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return presupuesto::class;
    }



    //==========================================================================
    // Funcion creada por JB para obtener el valor de un parametro de inmueble
    // Condominio_id = inmueble_id, param= nombre del parametro
    public function gValParam_sp($inmuid, $param)  // ya no se usa !!
    {   
        return \DB::select('call sp_cObtenValParam(?,?)', array($inmuid, $param));        
    } 

 
    //==========================================================================
    // Funcion creada por JB para obtener lista de presupuesto de un inmueble
    //=========================================================================
    // SELECT
    // presupuestos.id as presupid,
    // presupuestos.movtipo_id as movtipid,
    // movimiento_tipos.cve ,
    // movimiento_tipos.nombre,
    // presupuestos.monto
    // FROM
    // presupuestos  
    // INNER JOIN movimiento_tipos ON movimiento_tipos.id = presupuestos.movtipo_id 
    // WHERE
    // presupuestos.inmueble_id = 1  
    //=========================================================================
    public function gpresupuesto($inmuid)  
    {   
       return
        presupuesto::  
        select(      
        'presupuestos.id as presupid',
        'presupuestos.movtipo_id as movtipid',
        'movimiento_tipos.cve',
        'movimiento_tipos.nombre',
        'presupuestos.monto' 
              )       
        ->join("movimiento_tipos","movimiento_tipos.id","=",
              "presupuestos.movtipo_id")                           
        ->where('presupuestos.inmueble_id',$inmuid)
        ->orderBy('movimiento_tipos.cve','ASC')                
        ->get()
        //->toarray()
        ;             
    } 
    
    //=========================================================================

    public function gpresupaplicado($inmuid)  
    {   
       return
        presupuesto::  
        select(      
        'presupuestos.id as presupid',
        'presupuestos.movtipo_id as movtipid',
        'movimiento_tipos.cve',
        'movimiento_tipos.nombre',
        'presupuestos.monto' 
              )       
        ->join("movimiento_tipos","movimiento_tipos.id","=",
              "presupuestos.movtipo_id")                           
        ->where('presupuestos.inmueble_id',$inmuid)
        ->where('presupuestos.monto','>',0)
        ->orderBy('movimiento_tipos.cve','ASC')                
        ->get()
        //->toarray()
        ;             
    } 

    //==========================================================================
    // Funcion creada por JB para inicializar presupuesto del condominio
    // $inmuid = Condominio_id = inmueble_id 
    public function inicializa_sp($inmuid)  
    {   
        return \DB::select('call sp_InicializaPresupuesto(?)', array($inmuid));        
    } 

}