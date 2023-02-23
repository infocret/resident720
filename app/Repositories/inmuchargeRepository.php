<?php

namespace App\Repositories;

use App\Models\inmucharge;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class inmuchargeRepository
 * @package App\Repositories
 * @version September 2, 2019, 6:29 am UTC
 *
 * @method inmucharge findWithoutFail($id, $columns = ['*'])
 * @method inmucharge find($id, $columns = ['*'])
 * @method inmucharge first($columns = ['*'])
*/
class inmuchargeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'date',
        'folio',
        'stotal',
        'iva',
        'balance',
        'status',
        'description',
        'observ',
        'filelink'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return inmucharge::class;
    }

//**************** Nueva aplicación de cargos  2019   *******************************

    // Actualiza saldo y estatus devuelve el folio
    public function gDecPay($chrid,$cant)  // $chrid = inmucharge.id
    {     
     $charge = inmucharge::find($chrid);
     //$charge->decrement('balance',$cant);     
     $charge->balance = $charge->balance - $cant;
     //si el saldo es menor a 1 cambia estatus a pagado
     if ($charge->balance < 1 ){
      $charge->status = 'Pagado';     
     }
     else {
      $charge->status = 'Generado'; 
     }
     $charge->save();
     return $charge->folio;
    }
//*********************************************************************
// Funcion consulta general agrupada de cargos, pagos y Saldos por unidad
// perteneciente a un condominio, en un periodo de fechas

// SELECT
// inmuebles.id AS unidid,
// inmuebles.ident AS unidcve,
// inmuebles.descripcion AS unidnom,
// sum( inmucharges.stotal ) AS tcargo,
// sum( inmucharges.iva )AS tiva,
// (
// SELECT    
//  IF(Sum(inmumovtos.balance) IS NULL , 0, Sum(inmumovtos.balance) )    
// FROM
// inmumovtos
// INNER JOIN inmucharges ON inmucharges.id = inmumovtos.inmucharg_id
// INNER JOIN inmuebles ON inmuebles.id = inmucharges.inmu_id
// INNER JOIN unidadmovtos ON unidadmovtos.id = inmumovtos.unidmovto_id
// INNER JOIN catmovtos ON catmovtos.id = unidadmovtos.movto_id
// INNER JOIN relationship_properties 
// ON relationship_properties.son_property =  inmuebles.id 
// AND relationship_properties.parent_property = 68
// WHERE catmovtos.tipo = 'A' AND  inmuebles.id = unidid
// AND inmumovtos.date BETWEEN CAST('2019-10-01' AS DATE) 
// AND CAST('2019-10-30' AS DATE)
// ) as tpagos,
// sum( inmucharges.balance ) AS tsaldo
// FROM
// inmucharges
// INNER JOIN inmuebles ON inmucharges.inmu_id = inmuebles.id
// INNER JOIN relationship_properties 
// ON relationship_properties.parent_property = 68
// AND relationship_properties.son_property = inmuebles.id
// WHERE inmucharges.date BETWEEN CAST('2019-10-01' AS DATE) 
// AND CAST('2019-10-30' AS DATE)
// GROUP BY
// inmuebles.id, inmuebles.ident, inmuebles.descripcion 
// ORDER BY
// inmuebles.id
public function gChargePayBalance($condomid,$dfrom,$dto,$cservid)
{



$selq = "inmuebles.id AS unidid,
  inmuebles.ident AS unidcve,
  inmuebles.descripcion AS unidnom,
  inmucharges.conceptserv_id AS conceptserid,
  sum( inmucharges.stotal ) AS tcargo,
  sum( inmucharges.iva )AS tiva,
  (
  SELECT    
   IF(Sum(inmumovtos.balance) IS NULL , 0, Sum(inmumovtos.balance) )    
  FROM
  inmumovtos
  INNER JOIN inmucharges ON inmucharges.id = inmumovtos.inmucharg_id
  INNER JOIN inmuebles ON inmuebles.id = inmucharges.inmu_id
  INNER JOIN unidadmovtos ON unidadmovtos.id = inmumovtos.unidmovto_id
  INNER JOIN catmovtos ON catmovtos.id = unidadmovtos.movto_id
  INNER JOIN relationship_properties 
  ON relationship_properties.son_property =  inmuebles.id 
  AND relationship_properties.parent_property =". $condomid ;
  $selq .=" WHERE catmovtos.tipo = 'A' AND  inmuebles.id = unidid ";

  if ($cservid > 0) {
  $selq .= " AND inmucharges.conceptserv_id = conceptserid ";
  }

  $selq .=" AND inmumovtos.date BETWEEN CAST('".$dfrom."' AS DATE) 
  AND CAST('".$dto."' AS DATE) 
  ) as tpagos,
  sum( inmucharges.balance ) AS tsaldo";

  $query = inmucharge::selectraw( $selq )
           ->join('inmuebles', 'inmucharges.inmu_id', '=', 'inmuebles.id')
           ->join('relationship_properties',
            'relationship_properties.son_property', '=', 'inmuebles.id' )
           ->where('relationship_properties.parent_property', $condomid);
 
 if ($cservid > 0) {
      $query->where('inmucharges.conceptserv_id', $cservid);
 }
 $query->whereBetween('inmucharges.date' ,[$dfrom,$dto]);
 $query->groupBy('inmuebles.id', 'inmuebles.ident', 'inmuebles.descripcion', 'inmucharges.conceptserv_id' );
 $query->orderBy("inmuebles.id") ;

 return $query->get()        
 ;       
      
}

//*********************************************************************
// Funcion consulta general agrupada de cargos, pagos y Saldos por concepto
// perteneciente a un condominio y unidad, en un periodo de fechas

// SELECT
// inmuebles.id AS unidid,
// inmuebles.ident AS unidcve,
// inmuebles.descripcion AS unidnom,
// inmucharges.id as chrid,
// inmucharges.date AS chrdate,
// conceptservices.cve AS chrcve,
// inmucharges.folio AS chrfolio,
// inmucharges.description AS concepto,
// inmucharges.`status` AS chrstatus,
// sum( inmucharges.stotal ) AS tcargo,
// sum( inmucharges.iva )AS tiva,
// (
// SELECT    
//  IF(Sum(inmumovtos.balance) IS NULL , 0, Sum(inmumovtos.balance) )    
// FROM
// inmumovtos
// INNER JOIN inmucharges ON inmucharges.id = inmumovtos.inmucharg_id
// INNER JOIN inmuebles ON inmuebles.id = inmucharges.inmu_id
// INNER JOIN unidadmovtos ON unidadmovtos.id = inmumovtos.unidmovto_id
// INNER JOIN catmovtos ON catmovtos.id = unidadmovtos.movto_id
// INNER JOIN relationship_properties 
// ON relationship_properties.son_property =  inmuebles.id 
// AND relationship_properties.parent_property = 68
// WHERE catmovtos.tipo = 'A' AND  inmuebles.id = unidid
// AND inmumovtos.inmucharg_id = chrid
// AND inmumovtos.date BETWEEN CAST('2019-10-01' AS DATE) 
// AND CAST('2019-10-31' AS DATE)
// ) as tpagos,
// sum( inmucharges.balance ) AS tsaldo
// FROM
// inmucharges
// INNER JOIN inmuebles ON inmucharges.inmu_id = inmuebles.id
// INNER JOIN conceptservices 
// ON inmucharges.conceptserv_id = conceptservices.id
// INNER JOIN relationship_properties 
// ON relationship_properties.parent_property = 68
// AND relationship_properties.son_property = inmuebles.id
// WHERE
// inmuebles.id =71 AND
// inmucharges.date BETWEEN CAST('2019-10-01' AS DATE) 
// AND CAST('2019-10-31' AS DATE)
// GROUP BY
// inmuebles.id, inmuebles.ident, inmuebles.descripcion, inmucharges.description 
// ORDER BY
// inmuebles.id

public function gChargePayBalConcept($condomid,$unidid,$dfrom,$dto,$cservid)
{

$selq = "inmuebles.id AS unidid,
  inmuebles.ident AS unidcve,
  inmuebles.descripcion AS unidnom,
  inmucharges.conceptserv_id AS conceptserid,
  inmucharges.id as chrid,
  inmucharges.date AS chrdate,
  conceptservices.cve AS chrcve,
  inmucharges.folio AS chrfolio,
  inmucharges.description AS concepto,
  inmucharges.status AS chrstatus,
  sum( inmucharges.stotal ) AS tcargo,
  sum( inmucharges.iva )AS tiva,
  (
  SELECT    
   IF(Sum(inmumovtos.balance) IS NULL , 0, Sum(inmumovtos.balance) )    
  FROM
  inmumovtos
  INNER JOIN inmucharges ON inmucharges.id = inmumovtos.inmucharg_id
  INNER JOIN inmuebles ON inmuebles.id = inmucharges.inmu_id
  INNER JOIN unidadmovtos ON unidadmovtos.id = inmumovtos.unidmovto_id
  INNER JOIN catmovtos ON catmovtos.id = unidadmovtos.movto_id
  INNER JOIN relationship_properties 
  ON relationship_properties.son_property =  inmuebles.id 
  AND relationship_properties.parent_property =". $condomid ;

  $selq .=" WHERE catmovtos.tipo = 'A' AND  inmuebles.id = unidid";

  if ($cservid > 0) {
    $selq .= " AND inmucharges.conceptserv_id = conceptserid ";
  }

  $selq .= " AND inmumovtos.inmucharg_id = chrid
  AND inmumovtos.date BETWEEN CAST('".$dfrom."' AS DATE) 
  AND CAST('".$dto."' AS DATE)
  ) as tpagos,
  sum( inmucharges.balance ) AS tsaldo";

 
  $query = inmucharge:: selectraw( $selq )
 ->join('inmuebles', 'inmucharges.inmu_id', '=', 'inmuebles.id')
 ->join('conceptservices', 'inmucharges.conceptserv_id', 'conceptservices.id') 
 ->join('relationship_properties',
  'relationship_properties.son_property', '=', 'inmuebles.id' )
 ->where('relationship_properties.parent_property', $condomid)
 ->where('inmuebles.id',$unidid);

  if ($cservid > 0) {
      $query->where('inmucharges.conceptserv_id', $cservid);
  }

 $query->whereBetween('inmucharges.date' ,[$dfrom,$dto]);
 $query->groupBy('inmuebles.id', 'inmuebles.ident', 
  'inmuebles.descripcion', 'inmucharges.description',  'inmucharges.id',
  'inmucharges.date', 'conceptservices.cve', 'inmucharges.folio', 'inmucharges.description', 'inmucharges.status');
 $query->orderBy("inmuebles.id")  ;

  return $query->get()        
 ;          
      
}

//======================================================================================
//*********************************************************************
// Funcion creada por JB para listar Suma agrupada de cargos a unidades que pertenecen a un condominio 2019
    public function gNCondomiCargos($inmuid)  // $id = inmueble_id - Condominio
    {
        return
        inmucharge::
        selectraw(      
            'inmuebles.id as uid,
            inmuebles.ident as ucve,
            inmuebles.descripcion as uname,            
            sum(inmucharges.stotal+inmucharges.iva) as tcargos, 
            sum(inmucharges.balance) as tsaldo') 
         ->join("inmuebles", "inmuebles.id", "=",
              "inmucharges.inmu_id")
         ->join( "relationship_properties",  "relationship_properties.son_property","=", 
              "inmuebles.id")
         ->where( "relationship_properties.parent_property",$inmuid)
         ->groupBy("inmuebles.id","inmuebles.ident","inmuebles.descripcion")  
         ->orderBy("inmuebles.id")              
         ->get()        
        ;        
    }

// Funcion creada por JB para listar cabecera de movtos aplicados a una unidad
    public function gNUnidCargos($unidid)  // $id = inmueble_id - Unidad
    {
        return
        inmucharge::
        select(      
            'inmucharges.id AS hid',
            'inmuebles.ident as ucve',
            'inmuebles.descripcion AS uname',
            'propertyareas.descripcion AS area',
            'providers.nomcorto AS provee',   
            'conceptservices.cve AS ccve',
            'inmucharges.description AS desc',         
            'inmucharges.date AS ffact',
            'inmucharges.folio AS folio',
            'inmucharges.filelink AS doc',
            'inmucharges.stotal AS stot',            
            'inmucharges.iva',            
            'inmucharges.balance AS gtotal',
            'inmucharges.status AS stat'
           )          
         ->join("propertyareas", "inmucharges.proparea_id", "=",
              "propertyareas.id")
         ->join( "providers",  "inmucharges.provider_id","=", 
              "providers.id")
         ->join( "inmuebles",  "inmucharges.inmu_id","=", 
              "inmuebles.id")
         ->join( "conceptservices",  "inmucharges.conceptserv_id","=", 
              "conceptservices.id")
         ->where( "inmuebles.id",$unidid)         
         ->orderBy("inmucharges.id")              
         ->get()        
        ;    
    } 

// Funcion creada por JB para consultar cabecera de movimiento inmucharges
    public function gMovtoCH($mhid)  // $id = inmucharges_id - id de cabecera de movimientos 
    {
        return
        inmucharge::
        select(      
          'inmucharges.inmu_id AS unidid',         // id de unidad
          'providers.nomcorto AS providnom',                 // Nombre proveedor                 
          'providers.razonsocial AS providrazsoc',              // Razon soc proveedor
          'providers.rfcmoral AS providrfc',                 // RFC proveedor
          'inmuebles.ident AS unidcve',            // Cve de unidad
          'inmuebles.nombre AS unidname',          // Nombre de unidad
          'inmuebles.descripcion AS uniddesc',     // Descripcion de unidad
          'inmucharges.id AS chrid',              // id de Cargo por concepto Head
          'propertyareas.descripcion AS area',  // Area 
          'inmucharges.date AS chrdate',          // Fecha de Cargo  por concepto Head
          'inmucharges.folio AS chrfolio',                  // Folio de Cargo  por concepto Head
          'conceptservices.id AS conceptservid',        // Cve de Cargo  por concepto Head
          'conceptservices.cve AS chrcve',        // Cve de Cargo  por concepto Head
          'conceptservices.description AS cdesc',        // desc de Cargo  por concepto Head
          'inmucharges.description AS chrname',   // Descr. de Cargo  por concepto Head                  
          'inmucharges.stotal AS chrtotal',                 // Subtot. de Cargo  por concepto Head                   
          'inmucharges.iva AS chriva',                    // IVA de Cargo  por concepto Head                  
          'inmucharges.balance AS chrbalance',                // Total de Cargo  por concepto Head                  
          'inmucharges.status AS chrstatus',                 // Estatus de Cargo  por concepto Head                  
          'inmucharges.filelink AS chrflink'                // Link a archivo
           )    
        ->join( "inmuebles",  "inmucharges.inmu_id","=", 
              "inmuebles.id")
        ->join( "conceptservices",  "inmucharges.conceptserv_id","=", 
              "conceptservices.id")
        ->join("propertyareas", "inmucharges.proparea_id", "=",
              "propertyareas.id")
        ->join( "providers",  "inmucharges.provider_id","=", 
              "providers.id")
        ->where( "inmucharges.id",$mhid)         
         //->orderBy("inmucharges.id")              
        ->get()        
        ;    
    }

// Funcion creada por JB obtener nombre condominio
    public function gChCondomiName($unidid)  // $id = inmueble_id - unidad
    {
      return \DB::select('call sp_cNomCondomibyson(?)', array($unidid)); 
    }
    // Funcion que obtiene la clave del concepto por su id desde inmucharge
    public function gconceptocve($chid)
    {
      return
      inmucharge::
      select(            
      'conceptservices.cve AS chrcve', // Cve de Cargo  por concepto Head      
      'conceptservices.description AS chrdesc'
      )
      ->join( "conceptservices",  "inmucharges.conceptserv_id","=", 
          "conceptservices.id")
      ->where( "inmucharges.id",$chid)         
      ->first()        
      ;    
    }

//obtiene el nom y desc de el area que se relaciono a un inmucharge
public function garea($chid)
{
  return
      inmucharge::
      select(            
      'propertyareas.nombre',
      'propertyareas.descripcion'
      )
      ->join( "propertyareas","inmucharges.proparea_id","=", 
          "propertyareas.id")
      ->where( "inmucharges.id",$chid)         
      ->first()        
      ;    
}

//Obtiene nombre del proveedor por medio inmucharge.id
public function gprovider($chi)
{
//SELECT providers.nomcorto,providers.razonsocial,providers.rfcmoral
//FROM inmucharges
//INNER JOIN providers ON inmucharges.provider_id = providers.id
//WHERE inmucharges.id = 3
 return
      inmucharge::
      select(            
      'providers.nomcorto',
      'providers.razonsocial',
      'providers.rfcmoral'
      )
      ->join( "providers", "providers.id","=",
        "inmucharges.prvider_id")
      ->where( "inmucharges.id",$chid)         
      ->first()        
      ;  
}

///// ****************** Utilizadas para Egresos *******************  ///////
// SELECT
// inmuebles.id AS unidid,
// inmuebles.ident AS unidcve,
// inmuebles.descripcion AS unidnom,
// inmucharges.id AS chrid,
// inmucharges.date AS chrdate,
// conceptservices.cve AS chrcve,
// inmucharges.folio AS chrfolio,
// inmucharges.description AS concepto,
// providers.razonsocial,
// providers.nomcorto,
// inmucharges.`status` AS chrstatus,
// inmucharges.stotal AS tcargo,
// inmucharges.iva AS tiva
// FROM
// inmucharges
// INNER JOIN inmuebles ON inmuebles.id = inmucharges.inmu_id AND inmuebles.id = 68
// INNER JOIN conceptservices ON conceptservices.id = inmucharges.conceptserv_id
// INNER JOIN providers ON providers.id = inmucharges.provider_id
// WHERE inmucharges.date BETWEEN CAST('2020-01-01' AS DATE) AND CAST('2020-10-01' AS DATE)

public function gEgPayBalConcept($condomid,$dfrom,$dto)
{
 return
 inmucharge::
 selectraw("
  inmuebles.id AS condid,
  inmuebles.ident AS condcve,
  inmuebles.descripcion AS condnom,
  inmucharges.id as chrid,
  inmucharges.date AS chrdate,
  conceptservices.cve AS chrcve,
  inmucharges.folio AS chrfolio,
  inmucharges.description AS concepto,
  providers.razonsocial,
  providers.nomcorto,
  inmucharges.status AS chrstatus,
  inmucharges.stotal  AS cargo,
  inmucharges.iva AS iva,
  (
  SELECT    
   IF(Sum(inmumovtos.balance) IS NULL , 0, Sum(inmumovtos.balance) )    
  FROM
  inmumovtos
  INNER JOIN inmucharges ON inmucharges.id = inmumovtos.inmucharg_id
  INNER JOIN inmuebles ON inmuebles.id = inmucharges.inmu_id
  INNER JOIN unidadmovtos ON unidadmovtos.id = inmumovtos.unidmovto_id
  INNER JOIN catmovtos ON catmovtos.id = unidadmovtos.movto_id  
  WHERE catmovtos.tipo = 'P' AND  inmuebles.id = condid
  AND inmumovtos.inmucharg_id = chrid
  AND inmumovtos.date BETWEEN CAST('".$dfrom."' AS DATE) 
  AND CAST('".$dto."' AS DATE)
  ) as tpagos,
  inmucharges.balance AS saldo"
 )
 ->join('inmuebles', 'inmucharges.inmu_id', '=', 'inmuebles.id')
 ->join('conceptservices', 'inmucharges.conceptserv_id', 'conceptservices.id') 
 ->join('providers', 'inmucharges.provider_id', 'providers.id') 
 ->where('inmuebles.id',$condomid)
 ->whereBetween('inmucharges.date' ,[$dfrom,$dto]) 
 ->orderBy("inmuebles.id")              
 ->get()        
 ;       
      
}
//*********************************************************************************************


//
// Funcion que busca el concepto servicio 
// de un registro inmumovtos  por su inmumovto_id
// el resultado se usa en otra consulta que llena un select
// con lista de movimientos aplicables a ese tipo de conceptserv y unidad
public function getconceptserv($inmumovid)
{
// SELECT
//   inmucharges.inmu_id,
//   conceptservices.id,
//   catmovtos.tipo 
// FROM
//   inmucharges
//   INNER JOIN conceptservices ON inmucharges.conceptserv_id = conceptservices.id
//   INNER JOIN catmovtos ON conceptservices.id = catmovtos.conceptserv_id
//   INNER JOIN inmumovtos ON inmucharges.id = inmumovtos.inmucharg_id
//   INNER JOIN unidadmovtos ON inmumovtos.unidmovto_id = unidadmovtos.id 
//   AND catmovtos.id = unidadmovtos.movto_id 
// WHERE
//   inmumovtos.id = 744
  return inmucharge::select(
  'inmucharges.inmu_id',
  'conceptservices.id',
  'catmovtos.tipo'  
  // ,
  // 'inmumovtos.balance'
  )
    ->join('conceptservices', 'inmucharges.conceptserv_id' ,'conceptservices.id')  
    ->join('catmovtos', 'conceptservices.id' ,'catmovtos.conceptserv_id')
    ->join('inmumovtos', 'inmucharges.id' ,'inmumovtos.inmucharg_id')   
    ->join('unidadmovtos', function ($join) {
        $join->on('inmumovtos.unidmovto_id', '=', 'unidadmovtos.id')
             ->on('catmovtos.id', '=', 'unidadmovtos.movto_id');
    })     
    ->where('inmumovtos.id','=',$inmumovid)   
    ->first();  
}



}//fin clase repository
