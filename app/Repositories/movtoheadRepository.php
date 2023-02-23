<?php

namespace App\Repositories;

use App\Models\movtohead;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class movtoheadRepository
 * @package App\Repositories
 * @version July 27, 2018, 2:53 am UTC
 *
 * @method movtohead findWithoutFail($id, $columns = ['*'])
 * @method movtohead find($id, $columns = ['*'])
 * @method movtohead first($columns = ['*'])
*/
class movtoheadRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'movtype',
        'fechafactura',
        'folio',
        'doc_link',
        'stotal',
        'iva',
        'gtotal',
        'status'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return movtohead::class;
    }

// Funcion creada por JB para listar Suma agrupada de cargos a unidades que pertenecen a un condominio
    public function gCondomiCargos($inmuid)  // $id = inmueble_id - Condominio
    {
        return
        movtohead::
        selectraw(      
            'inmuebles.id as uid,
            inmuebles.ident as ucve,
            inmuebles.nombre as uname,            
            sum(movtoheads.gtotal) as tcargos')          
         ->join("inmuebles", "inmuebles.id", "=",
              "movtoheads.inmueble_id")
         ->join( "relationship_properties",  "relationship_properties.son_property","=", 
              "inmuebles.id")
         ->where( "relationship_properties.parent_property",$inmuid)
         ->groupBy("inmuebles.id","inmuebles.ident","inmuebles.nombre")  
         ->orderBy("inmuebles.id")              
         ->get()        
        ;        
    }

// Funcion creada por JB para listar cabecera de movtos aplicados a una unidad
    public function gUnidCargos($unidid)  // $id = inmueble_id - Unidad
    {
        return
        movtohead::
        select(      
            'movtoheads.id AS hid',
            'inmuebles.nombre AS uname',
            'propertyareas.descripcion AS area',
            'providers.nomcorto AS provee',
            'movtoheads.movtype AS tmov',
            'movtoheads.fechafactura AS ffact',
            'movtoheads.folio AS folio',
            'movtoheads.doc_link AS doc',
            'movtoheads.stotal AS stot',
            'movtoheads.iva',
            'movtoheads.gtotal AS gtotal',
            'movtoheads.status AS stat'
           )          
         ->join("propertyareas", "movtoheads.propertyarea_id", "=",
              "propertyareas.id")
         ->join( "providers",  "movtoheads.provider_id","=", 
              "providers.id")
         ->join( "inmuebles",  "movtoheads.inmueble_id","=", 
              "inmuebles.id")
         ->where( "inmuebles.id",$unidid)         
         ->orderBy("movtoheads.id")              
         ->get()        
        ;    

    }

// Funcion creada por JB para consultar cabecera de movimiento
    public function gMovtoH($mhid)  // $id = movtohead_id - id de cabecera de movimientos
    {
        return
        movtohead::
        select(      
          'movtoheads.inmueble_id AS uid',
          'inmuebles.ident AS ucve',
          'inmuebles.nombre AS uname',
          'inmuebles.descripcion AS udesc',
          'movtoheads.id AS hid',
          'movtoheads.movtype AS mtype',
          'movtoheads.fechafactura AS ffact',
          'movtoheads.folio',
          'propertyareas.descripcion AS area',
          'providers.nomcorto',
          'providers.razonsocial',
          'providers.rfcmoral',
          'movtoheads.stotal',
          'movtoheads.iva',
          'movtoheads.gtotal',
          'movtoheads.status',
          'movtoheads.doc_link'
           )    
         ->join( "inmuebles",  "movtoheads.inmueble_id","=", 
              "inmuebles.id")
        ->join("propertyareas", "movtoheads.propertyarea_id", "=",
              "propertyareas.id")
         ->join( "providers",  "movtoheads.provider_id","=", 
              "providers.id")
         ->where( "movtoheads.id",$mhid)         
         //->orderBy("movtoheads.id")              
         ->get()        
        ;    
    }


// Funcion creada por JB obtener nombre condominio
    public function gCondomiName($unidid)  // $id = inmueble_id - unidad
    {
      return \DB::select('call sp_cNomCondomibyson(?)', array($unidid)); 
    }





}

