<?php

namespace App\Repositories;

use App\Models\inmumovto;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class inmumovtoRepository
 * @package App\Repositories
 * @version September 2, 2019, 6:32 am UTC
 *
 * @method inmumovto findWithoutFail($id, $columns = ['*'])
 * @method inmumovto find($id, $columns = ['*'])
 * @method inmumovto first($columns = ['*'])
*/
class inmumovtoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'catmovto_cve',
        'date',
        'folio',
        'quantity',
        'amount',
        'balance',
        'status',
        'apmode',
        'description',
        'observ',
        'filelink'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return inmumovto::class;
    }


// Funcion creada por JB para listar movimientos de pago
// agrupados por Unidad
    public function gGroupPay($tmov)  // Tipo de movimiento C - Cargo A - Abono
    {
    // SELECT
    // inmuebles.id as unidid,
    // inmuebles.ident as unidcve,
    // inmuebles.descripcion as unidname,    
    // Sum(inmucharges.stotal) as tstotal,      
    // Sum(inmucharges.iva) as totiva,
    // Sum(inmumovtos.balance) as totpagos,
    // Sum(inmucharges.balance) as tsaldo'
    // FROM
    // inmumovtos 
    // INNER JOIN inmucharges ON inmucharges.id = inmumovtos.inmucharg_id
    // INNER JOIN inmuebles ON inmuebles.id = inmucharges.inmu_id
    // INNER JOIN unidadmovtos ON unidadmovtos.id = inmumovtos.unidmovto_id
    // INNER JOIN catmovtos ON catmovtos.id = unidadmovtos.movto_id
    // WHERE
    // catmovtos.tipo = 'A'
    // GROUP BY
    // inmuebles.ident,
    // inmuebles.nombre
    
        return
        inmumovto::
        selectraw(
        'inmuebles.id as unidid,
        inmuebles.ident as unidcve,
        inmuebles.descripcion as unidname,                  
        Sum(inmucharges.stotal) as tstotal,      
        Sum(inmucharges.iva) as totiva,
        Sum(inmumovtos.balance) as totpagos,
        Sum(inmucharges.balance) as tsaldo'
            )          
        ->join("inmucharges", "inmucharges.id", "=",
              "inmumovtos.inmucharg_id")         
        ->join("inmuebles", "inmuebles.id", "=",
              "inmucharges.inmu_id")
        ->join("unidadmovtos", "unidadmovtos.id", "=",
              "inmumovtos.unidmovto_id")
        ->join("catmovtos", "catmovtos.id", "=",
              "unidadmovtos.movto_id")                       
        ->where( "catmovtos.tipo",$tmov) 
        ->groupBy("inmuebles.id","inmuebles.ident","inmuebles.descripcion")          
        ->orderBy("inmuebles.id")              
        ->get()        
        ;        
    }

// Funcion creada por JB para listar suma de pagos de una unidad
// agrupados por concepto/servicio
    public function gUnidPays($unidid, $tmov)  // Tipo de movimiento C - Cargo A - Abono
    {

    // SELECT
    // inmuebles.id as unidid,
    // inmuebles.ident as unidcve,
    // inmuebles.descripcion as unidname,
    // inmucharges.id as chrid,
    // inmucharges.date as chrdate,
    // conceptservices.cve as chrcve,
    // inmucharges.description as chrdesc,
    // inmucharges.folio as chrfolio,
    // inmucharges.stotal as chrstot,
    // inmucharges.iva as chriva,
    // inmucharges.balance as chrsaldo,
    // Sum(inmumovtos.balance) as chrtotpagos
    // FROM
    // inmumovtos 
    // INNER JOIN inmucharges ON inmucharges.id = inmumovtos.inmucharg_id
    // INNER JOIN conceptservices ON conceptservices.id = inmucharg_id
    // INNER JOIN inmuebles ON inmuebles.id = inmucharges.inmu_id
    // INNER JOIN unidadmovtos ON unidadmovtos.id = inmumovtos.unidmovto_id
    // INNER JOIN catmovtos ON catmovtos.id = unidadmovtos.movto_id
    // WHERE
    // catmovtos.tipo = 'A'
    // AND
    // inmucharges.inmu_id = 69
    // GROUP BY
    // inmucharges.id
    
        return
        inmumovto::
        selectraw('inmuebles.id as unidid,
        inmuebles.ident as unidcve,
        inmuebles.descripcion as unidname,
        inmucharges.id as chrid,
        inmucharges.date as chrdate,
        conceptservices.cve as chrcve,
        inmucharges.description as chrdesc,
        inmucharges.folio as chrfolio,
        inmucharges.stotal as chrstot,
        inmucharges.iva as chriva,
        inmucharges.balance as chrsaldo,        
        Sum(inmumovtos.balance) as chrtotpagos'
            )          
        ->join("inmucharges", "inmucharges.id", "=",
              "inmumovtos.inmucharg_id") 
        ->join("conceptservices", "conceptservices.id", "=",
              "inmucharg_id")         
        ->join("inmuebles", "inmuebles.id", "=",
              "inmucharges.inmu_id")
        ->join("unidadmovtos", "unidadmovtos.id", "=",
              "inmumovtos.unidmovto_id")
        ->join("catmovtos", "catmovtos.id", "=",
              "unidadmovtos.movto_id")                       
        ->where( "catmovtos.tipo",$tmov) 
        ->where( "inmucharges.inmu_id",$unidid) 
        ->groupBy("inmuebles.id","inmuebles.ident",
            "inmuebles.descripcion","inmucharges.id","inmucharges.date",
            "conceptservices.cve","inmucharges.description",
            "inmucharges.folio","inmucharges.stotal","inmucharges.iva",
            "inmucharges.balance")          
        ->orderBy("inmucharges.id")              
        ->get()        
        ;        
    }

// Funcion creada por JB para listar pagos registrados 
// y aplicados a un cargo por concepto/servicio
// $chrid - id de inmucharges
// $tmov  - Tipo de movimiento C - Cargo A - Abono
    public function gChargePays($chrid,$unidid,$tmov)  
    {
    // SELECT
    // inmuebles.id as unidid,
    // inmuebles.ident as unidcve,
    // inmuebles.descripcion as unidname,
    // inmucharges.id as chrid,
    // inmucharges.date as chrdate,
    // conceptservices.cve as chrcve,
    // inmucharges.description as chrdesc,
    // inmucharges.folio as chrfolio,
    // inmucharges.balance as chrsaldo,
    // inmumovtos.id as movid,
    // inmumovtos.date as movdate,
    // inmumovtos.catmovto_cve as movtocve,
    // inmumovtos.description as movdesc,
    // inmumovtos.folio as movfolio,
    // inmumovtos.balance as movtpago
    // FROM
    // inmumovtos 
    // INNER JOIN inmucharges ON inmucharges.id = inmumovtos.inmucharg_id
    // INNER JOIN conceptservices ON conceptservices.id = inmucharg_id
    // INNER JOIN inmuebles ON inmuebles.id = inmucharges.inmu_id
    // INNER JOIN unidadmovtos ON unidadmovtos.id = inmumovtos.unidmovto_id
    // INNER JOIN catmovtos ON catmovtos.id = unidadmovtos.movto_id
    // WHERE
    // catmovtos.tipo = 'A'
    // AND
    // inmucharges.inmu_id = 69
    // AND
    // inmucharges.id = 1

    
        return
        inmumovto::
        select('inmuebles.id as unidid',
        'inmuebles.ident as unidcve',
        'inmuebles.descripcion as unidname',
        'inmucharges.id as chrid',
        'inmucharges.date as chrdate',
        'conceptservices.cve as chrcve',
        'inmucharges.description as chrdesc',
        'inmucharges.folio as chrfolio',
        'inmucharges.stotal as chrtotal',
        'inmucharges.iva as chriva',
        'inmucharges.balance as chrsaldo',
        'inmumovtos.id as movid',
        'inmumovtos.date as movdate',
        'inmumovtos.catmovto_cve as movtocve',
        'inmumovtos.description as movdesc',
        'inmumovtos.folio as movfolio',
        'inmumovtos.balance as movtpago'
            )          
        ->join("inmucharges", "inmucharges.id", "=",
              "inmumovtos.inmucharg_id") 
        ->join("conceptservices", "conceptservices.id", "=",
              "inmucharg_id")         
        ->join("inmuebles", "inmuebles.id", "=",
              "inmucharges.inmu_id")
        ->join("unidadmovtos", "unidadmovtos.id", "=",
              "inmumovtos.unidmovto_id")
        ->join("catmovtos", "catmovtos.id", "=",
              "unidadmovtos.movto_id")                       
        ->where( "catmovtos.tipo",$tmov) 
        ->where( "inmucharges.inmu_id",$unidid) 
        ->where( "inmucharges.id",$chrid)        
        ->orderBy("inmumovtos.id")              
        ->get()        
        ;        
    }
/*
    Lista los movimientos aplicados a a un concepto
*/
// SELECT
// inmumovtos.id,
// catmovtos.tipo,
// inmumovtos.date,
// inmumovtos.quantity,
// measurunits.nombre,
// inmumovtos.catmovto_cve,
// inmumovtos.description,
// inmumovtos.folio,
// inmumovtos.balance
// FROM
// inmumovtos
// INNER JOIN unidadmovtos ON inmumovtos.unidmovto_id = unidadmovtos.id
// INNER JOIN catmovtos ON unidadmovtos.movto_id = catmovtos.id
// INNER JOIN measurunits ON inmumovtos.measurunit_id = measurunits.id
// WHERE 
// catmovtos.tipo='A' AND
// inmumovtos.inmucharg_id=3
public function GetMovtos($chrid,$tipo)
{
   
     $query =   
        inmumovto::
        select(               
        'inmumovtos.id AS movid',
        'catmovtos.tipo AS movtipo',
        'inmumovtos.date AS movdate',
        'inmumovtos.quantity AS movcant',
        'inmumovtos.amount AS movpunit',
        'measurunits.nombre AS movumed',
        'inmumovtos.catmovto_cve AS movcve',
        'inmumovtos.description AS movdesc',
        'inmumovtos.folio AS movfolio',
        'inmumovtos.balance AS movbalance',
        'inmumovtos.status AS estatus',
            )          
        ->join("unidadmovtos", "unidadmovtos.id", "=",
              "inmumovtos.unidmovto_id")
        ->join("catmovtos", "catmovtos.id", "=",
              "unidadmovtos.movto_id")  
        ->join("measurunits", "inmumovtos.measurunit_id", "=",
              "measurunits.id")                 
        ->where( "inmumovtos.inmucharg_id",$chrid)        
        ->orderBy("inmumovtos.id")                      
        ; 

        if($tipo != 'T'){
          $query = $query->where("catmovtos.tipo",$tipo);         
        }        
        //dd($query);
        return $query->get();

}


public function GetPays($chrid,$tipo)
{
 $query =   
        inmumovto::
        selectraw(               
        'sum(inmumovtos.balance) AS tpagos'
            )  
        ->join("unidadmovtos", "unidadmovtos.id", "=",
              "inmumovtos.unidmovto_id")
        ->join("catmovtos", "catmovtos.id", "=",
              "unidadmovtos.movto_id") 
        ->where( "inmumovtos.inmucharg_id",$chrid)
        ->where("catmovtos.tipo", $tipo)                
        ;         
        return $query->first();    
}
  // Funcion creada por JB para listar movimientos aplicados de un cargo 
  // obtiene todos los tipos "C" - Cargos "A" - Abonos
    // public function gMovtos($headid)  // $id = inmucharges.id - Id de cabecera
    // {

    //         // SELECT
    //         // inmumovtos.id AS did,
    //         // unidadmovtos.inmu_id AS duni,
    //         // inmumovtos.quantity AS dcant,
    //         // measurunits.cve AS dmtype,
    //         // catmovtos.cve as cve,
    //         // catmovtos.`name` AS dmname,
    //         // catmovtos.description AS ddesc,
    //         // inmumovtos.amount AS dpunit,
    //         // inmumovtos.balance As dsubt
    //         // FROM
    //         // inmumovtos
    //         // INNER JOIN measurunits ON inmumovtos.measurunit_id = measurunits.id
    //         // INNER JOIN unidadmovtos ON inmumovtos.unidmovto_id = unidadmovtos.id
    //         // INNER JOIN catmovtos ON unidadmovtos.movto_id = catmovtos.id

    //     return
    //     inmumovto::
    //     select(
    //         'inmumovtos.id AS did',
    //         'inmumovtos.date AS ddate',
    //         'inmumovtos.quantity AS dcant',
    //         'unidadmovtos.inmu_id AS duni',
    //         'measurunits.cve AS dmtype',            
    //         'catmovtos.cve as cve',
    //         'catmovtos.name AS dmname',
    //         'catmovtos.description AS ddesc',
    //         'inmumovtos.amount AS dpunit',
    //         'inmumovtos.balance As dsubt',
    //         'inmumovtos.folio AS dfolio'
    //         )          
    //      ->join("measurunits", "inmumovtos.measurunit_id", "=",
    //           "measurunits.id")         
    //      ->join("unidadmovtos", "inmumovtos.unidmovto_id", "=",
    //           "unidadmovtos.id")  
    //     ->join("catmovtos", "unidadmovtos.movto_id", "=",
    //           "catmovtos.id")                       
    //      ->where( "inmumovtos.inmucharg_id",$headid)         
    //      ->orderBy("inmumovtos.id")              
    //      ->get()        
    //     ;        
    // }

}
