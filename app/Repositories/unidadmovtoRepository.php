<?php

namespace App\Repositories;

use App\Models\unidadmovto;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class unidadmovtoRepository
 * @package App\Repositories
 * @version September 2, 2019, 6:25 am UTC
 *
 * @method unidadmovto findWithoutFail($id, $columns = ['*'])
 * @method unidadmovto find($id, $columns = ['*'])
 * @method unidadmovto first($columns = ['*'])
*/
class unidadmovtoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'periodap',
        'validity',
        'amount',
        'nextap',
        'endvalidity',
        'observ'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return unidadmovto::class;
    }

public function gunidmovbyname($unidid, $name)
{
// SELECT
// unidadmovtos.id,
// unidadmovtos.inmu_id,
// catmovtos.shortname
// FROM
// unidadmovtos
// INNER JOIN catmovtos ON catmovtos.id = unidadmovtos.movto_id 
// WHERE catmovtos.shortname = 'PagoGas'
// AND unidadmovtos.inmu_id = 69
 return unidadmovto::select(
 'unidadmovtos.id',
 'unidadmovtos.inmu_id',
 'catmovtos.cve',
 'catmovtos.shortname',
 'catmovtos.description'
  )
 ->join("catmovtos", "catmovtos.id", "=",
              "unidadmovtos.movto_id")
->where('catmovtos.shortname','=',$name)
->where('unidadmovtos.inmu_id','=',$unidid)
->first();  
}

// Funcion creada por JB para listar movimientos aplicables a unidad 
// unidad y tipo de movimiento
 // $inmuid = inmueble_id - Condominio
 // $tipomov = 'C' - Cargo / 'A' -Abono
    public function gmovtoscontrato($inmuid, $tipomov)  
    {
// SELECT
// unidadmovtos.id,
// catmovtos.cve,
// catmovtos.tipo,
// catmovtos.description,
// inmuebles.descripcion
// FROM
// unidadmovtos
// INNER JOIN inmuebles ON unidadmovtos.inmu_id = inmuebles.id
// INNER JOIN catmovtos ON unidadmovtos.movto_id = catmovtos.id
// INNER JOIN conceptservices ON catmovtos.conceptserv_id = conceptservices.id
// WHERE
// inmuebles.id = 69 AND
// catmovtos.tipo = 'A'

        return
        unidadmovto::
        selectraw(      
            'unidadmovtos.id,
            catmovtos.cve,
            catmovtos.tipo,
            catmovtos.description,
            inmuebles.descripcion')          
         ->join("inmuebles", "unidadmovtos.inmu_id", "=",
              "inmuebles.id")
         ->join( "catmovtos",  "unidadmovtos.movto_id","=", 
              "catmovtos.id")
         ->join( "conceptservices",  "catmovtos.conceptserv_id","=", 
              "conceptservices.id")
         ->where( "inmuebles.id",$inmuid)
         ->where( "catmovtos.tipo",'like','%'.$tipomov.'%')         
         ->orderBy("unidadmovtos.id")              
         ->get()        
        ;        
    }

// Funcion creada por JB para listar movimientos aplicables a unidad 
// unidad, tipo de movimiento, concepto
 // $inmuid = inmueble_id - 
 // $tipomov = 'C' - Cargo / 'A' - Abono / 'E' - Egreso
 // $conceptservid = id de conceptservice
    public function gmovtoscontratob($inmuid, $tipomov, $conceptservid)  
    {        
        return
        unidadmovto::
        select(      
            'unidadmovtos.id',
            'catmovtos.conceptserv_id',
            'catmovtos.cve',
            'catmovtos.tipo',
            'catmovtos.description'
           )                   
         ->join( "catmovtos",  "unidadmovtos.movto_id","=", 
              "catmovtos.id")
         ->join( "conceptservices",  "catmovtos.conceptserv_id","=", 
              "conceptservices.id")
         ->where( "unidadmovtos.inmu_id",$inmuid)
         ->where( "catmovtos.tipo",$tipomov)         
         ->where( "catmovtos.conceptserv_id",$conceptservid)                  
         ->get()        
        ;        
    }

// Funcion creada por JB consultar catmovtos a partir de id de la relacion unidadmovto
// $unidmovtoid = id de tabla unidadmovtos
 
    public function gcatmovto($unidmovtoid)  
    {
        // SELECT
        // unidadmovtos.id,
        // unidadmovtos.inmu_id,
        // unidadmovtos.movto_id,
        // catmovtos.cve,
        // catmovtos.tipo,
        // catmovtos.shortname,
        // catmovtos.`name`,
        // catmovtos.description,
        // catmovtos.observ
        // FROM
        // unidadmovtos
        // INNER JOIN catmovtos ON unidadmovtos.movto_id = catmovtos.id
        // where 
        // unidadmovtos.id = 52

        return
        unidadmovto::
        selectraw(      
         'unidadmovtos.id,
         unidadmovtos.inmu_id,
         unidadmovtos.movto_id,
         catmovtos.cve,
         catmovtos.tipo,
         catmovtos.shortname,
         catmovtos.name,
         catmovtos.description,
         catmovtos.observ'
        )          
         ->join("catmovtos", "unidadmovtos.movto_id", "=",
              "catmovtos.id")        
         ->where( "unidadmovtos.id",$unidmovtoid)                    
         ->get()        
        ;        
    }


public function gunidmovchrmov($unidid, $concepid, $catmovid)
{
    // SELECT
    // unidadmovtos.id,
    // unidadmovtos.inmu_id,
    // unidadmovtos.movto_id,
    // conceptservices.cve,
    // conceptservices.shortname,
    // conceptservices.description,
    // catmovtos.cve,
    // catmovtos.shortname,
    // catmovtos.description
    // FROM
    // unidadmovtos
    // INNER JOIN catmovtos ON unidadmovtos.movto_id = catmovtos.id
    // INNER JOIN conceptservices ON catmovtos.conceptserv_id = conceptservices.id
    // WHERE
    // conceptservices.id = 1 AND
    // unidadmovtos.inmu_id = 69 AND
    // unidadmovtos.movto_id = 1
    return
    unidadmovto::
    select(  
    'unidadmovtos.id',
    'unidadmovtos.inmu_id',
    'unidadmovtos.movto_id',
    'conceptservices.cve',
    'conceptservices.shortname',
    'conceptservices.description',
    'catmovtos.cve',
    'catmovtos.shortname',
    'catmovtos.description'
    )
    ->JOIN('catmovtos','unidadmovtos.movto_id','catmovtos.id')
    ->JOIN('conceptservices','catmovtos.conceptserv_id','conceptservices.id')
    ->where('conceptservices.id',$concepid)
    ->where('unidadmovtos.inmu_id',$unidid)
    ->where('unidadmovtos.movto_id',$catmovid)
    ->first();

}


// Funcion que busca la cve del cargo aplicado para despues buscar
// unidadmovto.id y poder insertar el movimiento de pago
// al imprimir cheque
public function gcatmovcvebychargeid($chargeid)
{
// -- a partir del chargeid buscamos la clave que corresponde al pago
// SELECT 
// catmovtos.cve +2000
// FROM
// unidadmovtos
// INNER JOIN catmovtos ON catmovtos.id = unidadmovtos.movto_id  
// INNER JOIN inmumovtos ON inmumovtos.unidmovto_id = unidadmovtos.id
// INNER JOIN inmucharges ON inmumovtos.inmucharg_id = inmucharges.id
// WHERE
// inmucharges.id = 943;
return
    unidadmovto::
    select('catmovtos.cve')
     ->JOIN('catmovtos','unidadmovtos.movto_id','catmovtos.id')
     ->JOIN('inmumovtos','inmumovtos.unidmovto_id','unidadmovtos.id')
     ->JOIN('inmucharges','inmumovtos.inmucharg_id','inmucharges.id')
     ->where('inmucharges.id',$chargeid)
     ->first();
}

// Funcion que busca id de relacion unidadmovto
// a travez de la cve de catmovtos para insertar movimiento de pago
// al imprimir cheque
public function gunidmovbycatmovcve($movcve)
{
// -- con la clave de movto buscamos el id de unidadmovto
// SELECT
// unidadmovtos.id,
// unidadmovtos.inmu_id,
// unidadmovtos.movto_id
// FROM
// unidadmovtos
// INNER JOIN catmovtos ON unidadmovtos.movto_id = catmovtos.id
// WHERE
// catmovtos.cve = 2101;
return
    unidadmovto::
    select('unidadmovtos.id', 'unidadmovtos.observ','unidadmovtos.inmu_id') 
     ->JOIN('catmovtos','unidadmovtos.movto_id','catmovtos.id')     
     ->where('catmovtos.cve',$movcve)
     ->first();
}


}
