<?php

namespace App\Repositories;

use App\Models\conceptservice;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class conceptserviceRepository
 * @package App\Repositories
 * @version September 2, 2019, 6:18 am UTC
 *
 * @method conceptservice findWithoutFail($id, $columns = ['*'])
 * @method conceptservice find($id, $columns = ['*'])
 * @method conceptservice first($columns = ['*'])
*/
class conceptserviceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'cve',
        'shortname',
        'name',
        'description',
        'observ'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return conceptservice::class;
    }

    public function gconcbyid($conceptid)
    {
     return conceptservice::select(
        'conceptservices.id',
        'conceptservices.cve',
        'conceptservices.shortname',
        'conceptservices.name',
        'conceptservices.description',
        'conceptservices.observ'
       )
       ->where('conceptservices.id',$conceptid)
       ->first();
    }
// lista conceptos que estan asignados a un inmueble para egresos
public function gconcepts($inmuid)
{
// SELECT DISTINCT
// conceptservices.id,
// conceptservices.cve,
// conceptservices.`name`
// FROM
// conceptservices
// INNER JOIN catmovtos ON catmovtos.conceptserv_id = conceptservices.id
// INNER JOIN unidadmovtos ON unidadmovtos.movto_id = catmovtos.id
// WHERE
// unidadmovtos.inmu_id = 68
 return conceptservice::select(
'conceptservices.id',
'conceptservices.cve',
'conceptservices.name'
)
->distinct()
->join("catmovtos", "catmovtos.conceptserv_id", "=",
              "conceptservices.id")         
->join("unidadmovtos", "unidadmovtos.movto_id", "=",
              "catmovtos.id") 
->where('unidadmovtos.inmu_id',$inmuid)
->get();
}


// lista conceptos que estan asignados a un inmueble para anticipos
public function gconcepanticip($inmuid){
// SELECT DISTINCT
//     conceptservices.id, 
//     conceptservices.cve, 
//     conceptservices.shortname, 
//     conceptservices.`name`, 
//     conceptservices.description
// FROM
//     conceptservices
//     INNER JOIN
//     catmovtos
//     ON 
//         conceptservices.id = catmovtos.conceptserv_id
//     INNER JOIN
//     unidadmovtos
//     ON 
//         catmovtos.id = unidadmovtos.movto_id
// WHERE
//     unidadmovtos.inmu_id = 120
 return conceptservice::select(
'conceptservices.id',
'conceptservices.cve',
'conceptservices.shortname',
'conceptservices.name',
'conceptservices.description' 
)
->distinct()
->join("catmovtos", "catmovtos.conceptserv_id", "=", "conceptservices.id")         
->join("unidadmovtos", "unidadmovtos.movto_id", "=", "catmovtos.id") 
->where('unidadmovtos.inmu_id',$inmuid)
->get();

}

}
