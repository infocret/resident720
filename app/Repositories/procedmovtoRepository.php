<?php

namespace App\Repositories;

use App\Models\procedmovto;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class procedmovtoRepository
 * @package App\Repositories
 * @version January 29, 2021, 12:39 am UTC
 *
 * @method procedmovto findWithoutFail($id, $columns = ['*'])
 * @method procedmovto find($id, $columns = ['*'])
 * @method procedmovto first($columns = ['*'])
*/
class procedmovtoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'concept_cve',
        'movto_cve',
        'procedimiento',
        'parametros',
        'execauto',
        'nombre',
        'desc',
        'observ'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return procedmovto::class;
    }

 // Funcion creada por JB para listar procedimientos que aplican movimientos
 // SELECT
// procedmovtos.id,
// procedmovtos.inmueble_id,
// inmuebles.nombre,
// procedmovtos.conceptservice_id,
// conceptservices.`name`,
// procedmovtos.catmovto_id,
// catmovtos.`name`,
// procedmovtos.concept_cve,
// procedmovtos.movto_cve,
// procedmovtos.procedimiento,
// procedmovtos.parametros,
// procedmovtos.execauto,
// procedmovtos.nombre,
// procedmovtos.`desc`,
// procedmovtos.observ
// FROM
// procedmovtos
// INNER JOIN inmuebles ON procedmovtos.inmueble_id = inmuebles.id
// INNER JOIN conceptservices ON procedmovtos.conceptservice_id = conceptservices.id
// INNER JOIN catmovtos ON procedmovtos.catmovto_id = catmovtos.id
// 
    public function gProcedmovtos()  
    {
        return
        procedmovto::
        select(   
        'procedmovtos.id',
        'procedmovtos.inmueble_id',
        'inmuebles.nombre as condominio',
        'procedmovtos.conceptservice_id',
        'conceptservices.name as conceptnom',
        'procedmovtos.catmovto_id',
        'catmovtos.name as movtonom',
        'procedmovtos.concept_cve',
        'procedmovtos.movto_cve',
        'procedmovtos.procedimiento',
        'procedmovtos.parametros',
        'procedmovtos.execauto',
        'procedmovtos.nombre as spnom',
        'procedmovtos.desc',
        'procedmovtos.observ'            
            )          
        ->join("inmuebles", "procedmovtos.inmueble_id", "=", "inmuebles.id")  
        ->join("conceptservices", "procedmovtos.conceptservice_id", "=", 
            "conceptservices.id")
        ->join("catmovtos","procedmovtos.catmovto_id", "=", "catmovtos.id")        
         ->orderBy("procedmovtos.id")              
         ->get()        
        ;        
    }

 // Funcion creada por JB para listar condominios
    public function gcondoms()  
    {
        return
        \DB::select(
        'SELECT inmuebles.id, inmuebles.ident, inmuebles.nombre
         FROM
         inmuebles
         WHERE
        inmuebles.inmuebletipo_id = 1');        
    }

 // Funcion creada por JB para listar concdptos/serv
 public function gconcepts()  
    {

        return
        \DB::select(
        'SELECT
        conceptservices.id,
        conceptservices.cve,
        conceptservices.name
        FROM conceptservices');        
    }

 // Funcion creada por JB para listar movimientos de un concepto
 // que esten relacionadad en contrato de unidades de un condomin
 public function gmovtos($condmid,$servid)  
    {
    $sQuery = 'SELECT DISTINCT
        catmovtos.id as id,
        catmovtos.cve as movtocve,
        catmovtos.description as movtodesc,
        unidadmovtos.nextap as fechaaplica
        FROM
        conceptservices ,
        catmovtos ,
        unidadmovtos ,
        inmuebles
        INNER JOIN relationship_properties 
        ON relationship_properties.parent_property ='.$condmid.
        ' AND relationship_properties.son_property = inmuebles.id
        WHERE
        catmovtos.conceptserv_id = conceptservices.id AND
        unidadmovtos.inmu_id = inmuebles.id AND
        unidadmovtos.movto_id = catmovtos.id 
        and conceptservices.id ='.$servid.
        ' order by catmovtos.cve' ;
        return
        \DB::select($sQuery);        
    }

 // Funcion creada por JB para listar procedimientos en base de datos
 // select name from mysql.proc order by `name`

    public function gSps_onDb()  
    {

        $sQuery = 'select db as bd, name as nom, specific_name as spnom 
                    from mysql.proc WHERE db = "'.env('DB_DATABASE')
                    .'" AND type = "PROCEDURE" order by name';
        return
        \DB::select($sQuery);        
    }

 // Funcion creada por JB para listar datos de concepto/serv y movimiento
    public function gServMovto($condmid, $servid, $movtoid)  
    {
         $sQuery = '    
            SELECT DISTINCT
            conceptservices.id as conceptid,
            conceptservices.cve as conceptcve,
            conceptservices.name as conceptnom,
            catmovtos.id AS movtoid,
            catmovtos.cve AS movtocve,
            catmovtos.name AS movtonom,
            catmovtos.tipo AS movtotipo
            FROM
            conceptservices ,
            catmovtos ,
            unidadmovtos ,
            inmuebles
            INNER JOIN relationship_properties 
            ON relationship_properties.parent_property = '.$condmid.'
            AND relationship_properties.son_property = inmuebles.id
            WHERE
            catmovtos.conceptserv_id = conceptservices.id AND
            unidadmovtos.inmu_id = inmuebles.id AND
            unidadmovtos.movto_id = catmovtos.id 
            and conceptservices.id = '.$servid.'
            and unidadmovtos.id = '.$movtoid.'
            order by catmovtos.cve';            
        return
        \DB::select($sQuery);   
    }


 // Funcion creada por JB para obtener condominio
    public function gCondominio($condmid)  
    {
        $sQuery = 'SELECT inmuebles.id,inmuebles.ident,inmuebles.nombre FROM inmuebles
        WHERE inmuebles.id ='.$condmid ;

        return
        \DB::select($sQuery);   
    }


 // Funcion creada por JB para obtener unidades afectadas ,
 // de acuerdo a movimiento relacionado en contrato
    public function gUnidContrato($condmid,$movtoid)  
    {
        $sQuery = 'SELECT
        inmuebles.id AS unid_id,
        inmueble_tipos.ident AS unid_tipo,
        inmuebles.ident AS unid_cve,
        inmuebles.nombre AS unid_nom,
        unidadmovtos.nextap AS fech_aplica,
        unidadmovtos.amount
        FROM
        unidadmovtos
        INNER JOIN inmuebles ON unidadmovtos.inmu_id = inmuebles.id
        INNER JOIN inmueble_tipos ON inmuebles.inmuebletipo_id = inmueble_tipos.id
        INNER JOIN catmovtos ON unidadmovtos.movto_id = catmovtos.id
        INNER JOIN relationship_properties 
        ON relationship_properties.son_property = inmuebles.id 
        WHERE relationship_properties.parent_property = '.$condmid.
        ' AND catmovtos.id = '.$movtoid ;

        return
        \DB::select($sQuery);   
    }


 // Funcion creada por JB para actualizar fechas
    public function gUpdate($condmid,$movtoid,$nfecha)  
    {

        $sQuery = 'UPDATE unidadmovtos SET nextap = '; 
        $sQuery = $sQuery.'"'.$nfecha.'"'; 
        $sQuery = $sQuery.' WHERE unidadmovtos.movto_id = '.$movtoid ; 
        $sQuery = $sQuery.' AND unidadmovtos.inmu_id IN 
        ( SELECT inmuebles.id FROM inmuebles
        INNER JOIN relationship_properties ON relationship_properties.son_property = inmuebles.id
        AND relationship_properties.parent_property = ' ;
        $sQuery = $sQuery.$condmid.' )' ;

        return
        \DB::update($sQuery);   
    }

 // Funcion creada por JB para ejecutar procedimiento con parametros dinamicos
    public function execsp($spnom,$arrayparam)  
    {   
        $sQuery = 'call '.$spnom ;        
        if (count($arrayparam) > 0){
            //Si el array de parametros SI trae elementos            
            $sQuery = $sQuery.'(';
            //agrega N signos de ? para parametros
            $sQuery = $sQuery.str_repeat("?,", count($arrayparam)-1);
            $sQuery = $sQuery.'?)';           
            //dd($sQuery);  dd($arrayparam);
            return \DB::select($sQuery, $arrayparam);        
        }
        else{                       
            //Si el array de parametros NO trae elementos
            return \DB::select($sQuery);        
        }
    }




}  //fin clase
