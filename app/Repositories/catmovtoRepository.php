<?php

namespace App\Repositories;

use App\Models\catmovto;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class catmovtoRepository
 * @package App\Repositories
 * @version September 2, 2019, 6:22 am UTC
 *
 * @method catmovto findWithoutFail($id, $columns = ['*'])
 * @method catmovto find($id, $columns = ['*'])
 * @method catmovto first($columns = ['*'])
*/
class catmovtoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'cve',
        'tipo',
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
        return catmovto::class;
    }

public function gbytipo($tipo)
{
// SELECT
// catmovtos.id,
// catmovtos.conceptserv_id,
// catmovtos.cve,
// catmovtos.tipo,
// catmovtos.shortname,
// catmovtos.`name`,
// catmovtos.description
// FROM
// catmovtos
// WHERE
// catmovtos.tipo = 'C'

return catmovto::select(
'catmovtos.id',
'catmovtos.conceptserv_id',
'catmovtos.cve',
'catmovtos.tipo',
'catmovtos.shortname',
'catmovtos.name',
'catmovtos.description'
)
->where('catmovtos.tipo',$tipo)
->get()
;

}

// obtiene lista de tipos de movimiento de egresos para select
public function getmovegresos($condomid)
{
// SELECT
// catmovtos.id,
// catmovtos.cve,
// catmovtos.`name`
// FROM
// catmovtos
// INNER JOIN conceptservices ON catmovtos.conceptserv_id = conceptservices.id
// INNER JOIN unidadmovtos ON unidadmovtos.movto_id = catmovtos.id
// WHERE
// catmovtos.tipo = 'E' AND
// unidadmovtos.inmu_id = 68
// ORDER BY catmovtos.cve
return catmovto::
join("conceptservices","catmovtos.conceptserv_id","=",
              "conceptservices.id")
->join("unidadmovtos","unidadmovtos.movto_id","=",
              "catmovtos.id")
->where('catmovtos.tipo','E')
->where('unidadmovtos.inmu_id',$condomid)
->select('unidadmovtos.id','catmovtos.cve','catmovtos.name') 
->get()
;

}



}// fin clase
