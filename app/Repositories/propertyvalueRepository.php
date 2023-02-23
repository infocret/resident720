<?php

namespace App\Repositories;

use App\Models\propertyvalue;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class propertyvalueRepository
 * @package App\Repositories
 * @version October 27, 2018, 12:14 am UTC
 *
 * @method propertyvalue findWithoutFail($id, $columns = ['*'])
 * @method propertyvalue find($id, $columns = ['*'])
 * @method propertyvalue first($columns = ['*'])
*/
class propertyvalueRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'inmueble_id',
        'area',
        'porcentaje',
        'valor',
        'presupuesto',
        'cuota',
        'indiv1',
        'indiv2',
        'indiv3',
        'indiv4',
        'indiv5',
        'param1',
        'param2',
        'param3'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return propertyvalue::class;
    }
   //================================================
   // Funcion creada por JB para listar valores de unidades que pertenecen a un condominio
    public function gValUnids_sp($inmuid)  // $id = inmueble_id
    {   
        return \DB::select('call sp_cValoresUnidades(?)', array($inmuid));        
    }   
   //================================================
   // Funcion creada por JB para listar valores de unidades que pertenecen a un condominio
    public function gValUnids($inmuid)  // $id = inmueble_id
    {   
        return 
        propertyvalue::
        join("inmuebles","propertyvalues.inmueble_id","=","inmuebles.id")
        ->join("relationship_properties","relationship_properties.son_property","=","inmuebles.id")
        ->where('relationship_properties.parent_property',$inmuid) 
        ->orderBy('inmuebles.id','ASC')                
        ->select(      
        "propertyvalues.id AS propvalid",
        "inmuebles.id AS unidid",
        "inmuebles.ident AS cve",
        "inmuebles.nombre AS nombre",
        "propertyvalues.area AS dimencion",
        "propertyvalues.porcentaje AS porcentaje",
        "propertyvalues.valor AS valor",
        "propertyvalues.presupuesto AS presupuesto",
        "propertyvalues.cuota AS cuota",
        "propertyvalues.param1 AS p1",
        "propertyvalues.param2 AS p2",
        "propertyvalues.param3 AS p3",
        "relationship_properties.parent_property as parent",
        "relationship_properties.son_property as son"    
        )
        ->get()
        //->toarray()
        ;        
    }         
    //================================================
    // Funcion creada por JB para obtener el valor de un parametro de inmueble
    // Condominio_id = inmueble_id, param= nombre del parametro
    public function gValParam_sp($inmuid, $param)  
    {   
        return \DB::select('call sp_cObtenValParam(?,?)', array($inmuid, $param));        
    } 
    //================================================
    // Funcion creada por JB para listar valores de INDIVISOS de unidades que pertenecen a un condominio
    public function gIndivUnids_sp($inmuid)  // $id = inmueble_id
    {   
        return \DB::select('call sp_cIndivisosUnidades(?)', array($inmuid));        
    }   

   //================================================
   // Funcion creada por JB para listar valores indivisos todas las 
   // unidades que pertenecen a un condominio
    public function gIndivlUnids($inmuid)  // $id = inmueble_id
    {   
        return 
        propertyvalue::
        join("inmuebles","propertyvalues.inmueble_id","=","inmuebles.id")
        ->join("relationship_properties","relationship_properties.son_property","=","inmuebles.id")
        ->where('relationship_properties.parent_property',$inmuid) 
        ->orderBy('inmuebles.id','ASC')                
        ->select(      
        "propertyvalues.id AS propvalid",
        "inmuebles.id AS unidid",
        "inmuebles.ident AS cve",
        "inmuebles.nombre AS nombre",
        "propertyvalues.indiv1",
        "propertyvalues.indiv2",
        "propertyvalues.indiv3",
        "propertyvalues.indiv4",
        "propertyvalues.indiv5",
        "relationship_properties.parent_property as parent",
        "relationship_properties.son_property as son"    
        )
        ->get()
        //->toarray()
        ;        
    } 
    //================================================
   // Funcion creada por JB para listar valores indivisos de una unidad
    public function gIndivlUnid($inmuid)  // $id = inmueble_id
    {   
        return 
        propertyvalue::select(      
        "propertyvalues.id",       
        "propertyvalues.indiv1",
        "propertyvalues.indiv2",
        "propertyvalues.indiv3",
        "propertyvalues.indiv4",
        "propertyvalues.indiv5"        
        )
        ->where('propertyvalues.inmueble_id',$inmuid) 
        ->get()        
        ;        
    } 

 //================================================
   // Funcion creada por JB para obtener el valor de la cuota de una unidad
    public function gIndiv1CuotaUnid($inmuid)  // $id = inmueble_id = Unidad
    {   
        return 
        propertyvalue::select(      
        "propertyvalues.id",
        "propertyvalues.indiv1",       
        "propertyvalues.cuota"             
        )
        ->where('propertyvalues.inmueble_id',$inmuid) 
        ->get()        

        ;        
    }     
 //================================================
   // Funcion creada por JB para listar valores indiviso1 de todas las 
   // unidades que pertenecen a un condominio y su cuota actual
    public function gCuotasUnids($inmuid)  // $id = inmueble_id
    {   
        return 
        propertyvalue::
        join("inmuebles","propertyvalues.inmueble_id","=","inmuebles.id")
        ->join("relationship_properties","relationship_properties.son_property","=","inmuebles.id")
        ->where('relationship_properties.parent_property',$inmuid) 
        ->orderBy('inmuebles.id','ASC')                
        ->select(      
        "propertyvalues.id AS propvalid",
        "inmuebles.id AS unidid",
        "inmuebles.ident AS cve",
        "inmuebles.nombre AS nombre",
        "propertyvalues.indiv1",
        "propertyvalues.cuota",
        "relationship_properties.parent_property as parent",
        "relationship_properties.son_property as son"    
        )
        ->get()
        //->toarray()
        ;        
    }     
    //================================================
    // Funcion creada por JB para devolver el calculo de cuotas de unidades
    // Condominio_id = inmueble_id, param= variable que recibe parametro de salida
    // public function gCreaCuotas($inmuid)  //Ya no se usa
    // {   
        
    //     $cuot = \DB::select('call sp_cCreaCuotas(?)', array($inmuid));         
    //     //dd($cuot);
        
    //     return $cuot;
    //     //return \DB::select('call sp_cCreaCuotas(?,?)', array($inmuid, $param)); 

    // }     
}
