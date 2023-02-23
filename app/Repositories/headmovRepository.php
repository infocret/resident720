<?php

namespace App\Repositories;

use App\Models\headmov;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class headmovRepository
 * @package App\Repositories
 * @version June 20, 2018, 6:43 am UTC
 *
 * @method headmov findWithoutFail($id, $columns = ['*'])
 * @method headmov find($id, $columns = ['*'])
 * @method headmov first($columns = ['*'])
*/
class headmovRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'fecharegistro',
        'fechafactura',
        'folio',
        'doc',
        'stotal',
        'iva',
        'gtotal'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return headmov::class;
    }
//================================================
     // Funcion creada por JB para listar  unidades para llenado de select
    public function gMovimientos($pinmuid,$apfeini,$apfefin,$fcfeini,$fcfin,$fol,$provid)  
    {   
         //     7 Parametros : 
         // imuid - Id de inmueble tinyint
         // apfeini - Fecha aplicacion (fecharegistro) inicio de periodo varchar(8)
         // apfefin - Fecha aplicacion (fecharegistro) fin de periodo varchar(8)
         // fcfeini -   Fecha factura (fechafactura) inicio de periodo varchar(8)
         // fcfin       - Fecha factura (fechafactura) fin de periodo   varchar(8)
         // fol         -   Folio varchar(25)
         // provid - id de proveedor tinyint
         // 
         //      Ordenado por fecha aplicacion 
         //      Ejemplo
         //          sp_cMovimientos (1,'','','','','',0)  
         //          sp_cMovimientos (0,'20180101','20991231','20180101','20991231','',0)  
         //          
         // Devuelve: 
         //  id, cve , inmunombre , area , provider ,fechaaplica ,
         //  fechafact , folio , subtotal , iva ,gtotal , doc 
         //    
         //    como:
         //  id , cve , inmunombre , area , provider , fechaplica , 
         //  fechafact , folio , subtotal , iva , gtotal ,  doc
         //    
         //    
         //  
    $Movtos =  \DB::select('call sp_cMovimientos(?,?,?,?,?,?,?)',array($pinmuid,$apfeini,$apfefin,$fcfeini,$fcfin,$fol,$provid));

    // if (!empty($Movtos)) {
    //     $Movtos;  // variable para regresar array asociativo          
    //     // **** Declara Array contenedor *******
    //     $movs = array();
    //     // Ciclo barre array de consulya y crea array asociativo
    //     foreach($Movtos as $Mov){                   
    //          //Crea array interno
    //          $in_movs = array(  
    //          'id' => $Mov->id,
    //          'cve' => $Mov->cve,              
    //          'inmunombre' => $Mov->inmunombre,
    //          'area' => $Mov->area,
    //          'provider' => $Mov->provider,
    //          'fechaaplica' => $Mov->fechaplica,
    //          'fechafact' => $Mov->fechafact,
    //          'foliofolio' => $Mov->folio,
    //          'subtotal' => $Mov->subtotal,
    //          'iva' => $Mov->iva,
    //          'gtotal' => $Mov->gtotal,
    //          'doc' => $Mov->doc
    //          );  
    //       // inserta el array interno al array contenedor
    //       array_push($movs,$in_movs);                               
    //     }
    //     $Movtos = $movs; // asigna array contenedor a variable para devolver 
    //     //**************************************************
    // }
    // else{
    //      $Movtos["0"] = "Sin datos";   // sin la consulta no trae nada devuelve un elemento
    // }

    return $Movtos;           
    }    
    // Funcion creada por JB para listar  inmuebles para llenado de select
    public function gInmuLista($opcion)  
    {   
        $cinmuebles = \DB::select('call sp_cInmueblesLista(?)',array($opcion));
        if (!empty($cinmuebles)) {        
            $Inmuebles;  // variable para regresar array asociativo
            // Ciclo que barre array original y crea array asociativo
            foreach($cinmuebles as $inmueble){                   
                $Inmuebles[ $inmueble->id] = $inmueble->nombre;                                  
            }
        }
        else{
             $Inmuebles["0"] = "Sin datos";   
        }
        return $Inmuebles;
    }   
    //================================================
    // Funcion creada por JB para listar  tipos de movimientos para llenado de select
    public function gTiposMovimiento($tipo)  
{       
    $cTmovtos =  \DB::select('call sp_cTiposMovimiento(?)',array($tipo));
    if (!empty($cTmovtos)) {
        $Tmovtos;  // variable para regresar array asociativo          
        // **** Declara Array contenedor *******
        $tmovs = array();
        // Ciclo barre array de consulya y crea array asociativo
        foreach($cTmovtos as $Tmovto){                   
             //Crea array interno
             $in_tmovs = array(  
             'id' => $Tmovto->id,
             'cve' => $Tmovto->cve,              
             'nombre' => $Tmovto->nombre                
             );  
          // inserta el array interno al array contenedor
          array_push($tmovs,$in_tmovs);                               
        }
        $Tmovtos = $tmovs; // asigna array contenedor a variable para devolver 
        //**************************************************
    }
    else{
         $Tmovtos["0"] = "Sin datos";   // sin la consulta no trae nada devuelve un elemento
    }

    return $Tmovtos;        
}
    
    //================================================
    // Funcion creada por JB para listar  areas de propiedades  para llenado de select
    // parametros
    //  opcion :    0 obtiene la lista  con campos separados
    //              1 obtiene la lista con campos compuestos para select
    //  inmu_id:    0 Obtiene las areas de todos los inmuebles
    //              1  obtiene las areas solo del inmueble cuyo id=inmueble_id
    public function gPropertyAreas($opcion, $inmu_id)  
    {   
        $cPropAreas = \DB::select('call sp_cPropertyAreas(?,?)',array($opcion,$inmu_id));
        if (!empty($cPropAreas)) { 
            $PropAreas;  // variable para regresar array asociativo
            // Ciclo que barre array original y crea array asociativo
            foreach($cPropAreas as $PropArea){                   
                $PropAreas[ $PropArea->id] = $PropArea->nombre;                                  
            }
        }
        else {
            $PropAreas["0"] = "Sin datos";  
        }
        return $PropAreas;               
    }

    
    //================================================
    // Funcion creada por JB para listar  proveedores para llenado de select
    public function gProviders($opcion)  
    {   
         $cProviders = \DB::select('call sp_cProviders(?)',array($opcion)); 
         if (!empty($cProviders)) { 
             $Providers;  // variable para regresar array asociativo
            // Ciclo que barre array original y crea array asociativo
            foreach($cProviders as $Provider){                   
                $Providers[ $Provider->id] = $Provider->provname;                                  
            }
        }
        else{
             $Providers["0"] = "Sin datos";  
        }
        return $Providers;          
    }    
         // Funcion creada por JB para listar  unidades para llenado de select
    public function gUnidades($tipo)  
    {   
         $cUnidades = \DB::select('call sp_cUnidades(?)',array($tipo)); 
         if (!empty($cUnidades)) { 
             $Unidades;  // variable para regresar array asociativo
            // Ciclo que barre array original y crea array asociativo
            foreach($cUnidades as $Unidad){                   
                $Unidades[ $Unidad->cve] = $Unidad->nombre;                                  
            }
        }
        else{
             $Unidades["0"] = "Sin datos";  
        }
        return $Unidades;          
    }    
   

}
