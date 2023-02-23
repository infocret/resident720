<?php

namespace App\Repositories;

use App\Models\inmueble;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class inmuebleRepository
 * @package App\Repositories
 * @version February 16, 2018, 8:24 am UTC
 *
 * @method inmueble findWithoutFail($id, $columns = ['*'])
 * @method inmueble find($id, $columns = ['*'])
 * @method inmueble first($columns = ['*'])
*/
class inmuebleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'ident' => 'like',
        'nombre'=> 'like',
        'descripcion' => 'like'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return inmueble::class;
    }




    //Obtiene el tipo de inmueble
    public function gtipo($condmid)
    {
        $tipos = inmueble::select('inmuebles.inmuebletipo_id')
        ->where('id',$condmid)
        ->get()
        ;
        $tipo = $tipos[0]->inmuebletipo_id;
        return $tipo;
    }




    //busca imuble por campo ident
    public function ginmubynom($condmid,$nom)
    {
        return \DB::select('call sp_unidadbynom (?,?)', array($condmid,$nom)); 
    }


 //================================================
   // Funcion creada por JB para listar unidades que pe
   // rtenecen a un condominio
    public function gInmuUnidades_sp($id)  // $id = inmueble_id
    {   
    // BEGIN
    // SELECT
    // relationship_properties.parent_property,
    // inmuebles.id,
    // inmuebles.inmuebletipo_id,
    // inmuebles.ident,
    // inmuebles.nombre,
    // inmuebles.descripcion
    // FROM
    // inmuebles ,
    // relationship_properties
    // WHERE
    // inmuebles.id = relationship_properties.son_property AND
    // relationship_properties.parent_property = inmu;
    // END
        return \DB::select('call sp_cInmUnidades(?)', array($id));        
    }    
  // Funcion creada por JB para listar unidades que pertenecen a un condominio
    public function gInmuUnidades($inmuid)  // $id = inmueble_id
    {
        return
        inmueble::  
         join("relationship_properties","inmuebles.id","=",
              "relationship_properties.son_property")  
        // ->  join("headmovs","inmuebles.id","=",
        //       "relationship_properties.son_property")                  
        ->where('relationship_properties.parent_property',$inmuid)
        ->orderBy('inmuebles.id','ASC')                
        ->select(      
        'relationship_properties.parent_property',
        'inmuebles.id',
        'inmuebles.inmuebletipo_id',
        'inmuebles.ident',
        'inmuebles.nombre',
        'inmuebles.descripcion'
        // ,
        // 'headmovs.stotal'
        )
        ->get()
        //->toarray()
        ;        
    }
// Funcion creada por JB para listar unidades que pertenecen a un condominio y llenar select
    public function gselUnidades($inmuid)  // $id = inmueble_id
    {
        //  $raw =  \DB::raw("concat (
        //  inmuebles.ident,
        //  '-',
        // inmuebles.nombre) as unid");
        return
        inmueble::  
         join("relationship_properties","inmuebles.id","=",
              "relationship_properties.son_property")             
        ->where('relationship_properties.parent_property',$inmuid)
        ->orderBy('inmuebles.id','ASC') 
        ->pluck('inmuebles.ident','inmuebles.id')->toarray();               
        // ->select(             
        // 'inmuebles.id',        
        // $raw      
        // )
        // ->get()
        // ->toarray()
        ;        
    }
 //================================================    
 //================================================
   // Funcion creada por JB para guardar unidad
    public function saveUnidad($paramarray)  // $id = inmueble_id
    {      
    //dd($paramarray);  // 21 parametros
    $resultado = \DB::select('call sp_iUnidad(
        ?,?,?,?,?,
        ?,?,?,?,?,
        ?,?,?,?,?,
        ?,?,?,?,?,?)', $paramarray);        
    //dd($resultado);
    //$paramOut = $resultado->fetchAll();
        return $resultado;
    }   
   //================================================
   // Funcion creada por JB para guardar condominio 
    public function saveCondom($paramarray)  // $id = inmueble_id
    {      
    //dd($paramarray);  // 19 parametros
    $resultado = \DB::select('call sp_iCondominio(
        ?,?,?,?,?,
        ?,?,?,?,?,
        ?,?,?,?,?,
        ?,?,?,?)', $paramarray);        
    //dd($resultado);
    //$paramOut = $resultado->fetchAll();
        return $resultado;
    }   
    //================================================
    
    // Funcion creada por JB para consultar condominos de un condominio
    public function gCondominos($id)  // $id = inmueble_id
    {      
        return \DB::select('call sp_cCondominos (?)', array($id)); 
    }
    //================================================    
    // Funcion creada por JB para consultar miembros del comite
    public function gConomite($id)  // $id = inmueble_id
    {      
        return \DB::select('call sp_cComite (?)', array($id)); 
    }
    //================================================             
    // Funcion creada por JB para listar inmuebles de un solo tipo
    public function gInmueblebytype($condid, $inmutypeid)  // $inmutypeid = inmuebletype_id
    {      
       if ($condid > 0){
        $inmus = inmueble::where("inmuebletipo_id",$inmutypeid)
        ->where("inmuebles.id",$condid)
        ->paginate(5);     
       }
       else{        
       $inmus = inmueble::where("inmuebletipo_id",$inmutypeid)       
        ->paginate(5);     
      }
    return $inmus;
    }   

    // Funcion creada por JB para listar inmuebles de un solo tipo
    public function gInmueblebytypeb( $inmutypeid)  // $inmutypeid = inmuebletype_id
    {      
       
    $inmus = inmueble::where("inmuebletipo_id",$inmutypeid)       
      ->paginate(5);     
      
    return $inmus;
    }


   // Funcion creada por JB para listar personas asignadas a un inmueble
    public function gPersonas($id)  // $id = inmueble_id
    {      
        return \DB::select('call sp_cPersonasAsigCondom(?)', array($id)); 
    }

    // Funcion creada por JB para listar condominios
    public function gCondominios()  
    {
        return
        inmueble:: select(              
        'inmuebles.id',        
        'inmuebles.nombre'        
        )
        ->where('inmuebles.inmuebletipo_id',1)
        ->orderBy('inmuebles.nombre','ASC')                
        ->get()
        //->toarray()
        ;        
    }

    // Funcion creada por JB para insertar personas asignadas a unidad
    public function iPersonas($arraypersons)  // $id = inmueble_id
    {      
        return \DB::select(
            'call sp_iPersonasdeUnidad(?,?,?,?,?,?,?,?,?,?,?)', 
            $arraypersons); 
    }

public function getegresos($condomid,$fini,$ffin)
{
//     $egresos = inmuebles::selectraw(
// "SELECT
// inmuebles.id AS inmuid,
// inmuebles.ident AS inmucve,
// inmuebles.descripcion AS inmuname,
// inmucharges.id AS chargeid,
// inmucharges.date AS chargedate,
// inmucharges.conceptserv_id AS chrconceptid,
// conceptservices.cve AS conceptcve,
// conceptservices.description AS conceptdesc,
// catmovtos.id AS catmovid,
// catmovtos.cve AS catmovcve,
// catmovtos.description AS catmovdesc,
// inmucharges.folio AS chargefol,
// inmucharges.description AS chargedesc,
// providers.id AS provid,
// providers.razonsocial AS provrazsoc,
// inmucharges.status AS chargestat,
// inmucharges.stotal AS chargetot,
// inmucharges.iva AS chargeiva,
// inmucharges.balance AS chargesaldo
// FROM
// inmuebles
// INNER JOIN inmucharges ON inmucharges.inmu_id = inmuebles.id
// INNER JOIN inmumovtos ON inmumovtos.inmucharg_id = inmucharges.id
// INNER JOIN conceptservices ON inmucharges.conceptserv_id = conceptservices.id
// INNER JOIN catmovtos ON catmovtos.conceptserv_id = conceptservices.id
// INNER JOIN unidadmovtos ON unidadmovtos.movto_id = catmovtos.id 
// AND unidadmovtos.inmu_id = inmuebles.id 
// AND inmumovtos.unidmovto_id = unidadmovtos.id
// INNER JOIN providers ON inmucharges.provider_id = providers.id
// where inmuebles.id = 68
// ORDER BY inmucharges.id");


 // $egresos =
 //        inmueble:: select(
 //        'inmuebles.id AS inmuid',
 //        'inmuebles.ident AS inmucve',
 //        'inmuebles.descripcion AS inmuname',
 //        'inmucharges.id AS chargeid',
 //        'inmucharges.date AS chargedate',
 //        'inmucharges.conceptserv_id AS chrconceptid',
 //        'conceptservices.cve AS conceptcve',
 //        'conceptservices.description AS conceptdesc',
 //        'catmovtos.id AS catmovid',
 //        'catmovtos.cve AS catmovcve',
 //        'catmovtos.description AS catmovdesc',
 //        'inmucharges.folio AS chargefol',
 //        'inmucharges.description AS chargedesc',
 //        'providers.id AS provid',
 //        'providers.razonsocial AS provrazsoc',
 //        'inmucharges.`status` AS chargestat',
 //        'inmucharges.stotal AS chargetot',
 //        'inmucharges.iva AS chargeiva',
 //        'inmucharges.balance AS chargesaldo'   
 //        )
 //        ->join("inmucharges","inmucharges.inmu_id","inmuebles.id") 
 //        ->join("inmumovtos","inmumovtos.inmucharg_id","inmucharges.id")         
 //        ->join("conceptservices","inmucharges.conceptserv_id","conceptservices.id")
 //        ->join("catmovtos","catmovtos.conceptserv_id","conceptservices.id")
 //        ->join("unidadmovtos","unidadmovtos.movto_id","catmovtos.id")
 //        ->join("unidadmovtos","unidadmovtos.inmu_id","inmuebles.id")
 //        ->join("unidadmovtos","unidadmovtos.id","inmumovtos.unidmovto_id")
 //        ->join("providers","inmucharges.provider_id","providers.id")
 //        ->where("inmuebles.id",$condomid)
 //        ->orderBy('inmucharges.id','ASC')
 //        ->get() ;

  $egresos = \DB::select(
            'call sp_egresos(?,?,?)',  array($condomid,$fini,$ffin)); 

//dd($egresos);
        return $egresos;

}


// Funcion creada por JB para listar unidades que pertenecen a un condominio 
// y llenar select de create de egresos
    public function gselUnidadesB($inmuid)  // $id = inmueble_id
    {
        return
        inmueble::  
         join("relationship_properties","inmuebles.id","=",
              "relationship_properties.son_property")             
        ->where('relationship_properties.parent_property',$inmuid)
        ->orderBy('inmuebles.id','ASC') 
        ->select('inmuebles.id','inmuebles.ident','inmuebles.nombre','inmuebles.descripcion')
        ->get();               
    }



}
