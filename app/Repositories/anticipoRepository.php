<?php

namespace App\Repositories;

use App\Models\anticipo;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class anticipoRepository
 * @package App\Repositories
 * @version April 11, 2022, 8:02 pm UTC
 *
 * @method anticipo findWithoutFail($id, $columns = ['*'])
 * @method anticipo find($id, $columns = ['*'])
 * @method anticipo first($columns = ['*'])
*/
class anticipoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'fechareg',
        'folio',
        'cobertura',
        'montoini',
        'saldo',
        'status',
        'desc',
        'observ',
        'docto',
        'filelink',
        'userreg'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return anticipo::class;
    }

    /**
     * Obtener anticipos por condominio
     **/
    public function ganticbycondomid($condomid)
    {
// SELECT
//     anticipos.fechareg, 
//     inmuebles.ident, 
//     inmuebles.nombre, 
//     conceptservices.cve, 
//     conceptservices.shortname, 
//     anticipos.cobertura, 
//     anticipos.observ, 
//     anticipos.folio, 
//     anticipos.`status`, 
//     anticipos.userreg, 
//     anticipos.`desc`, 
//     anticipos.docto,
//     anticipos.montoini, 
//     anticipos.saldo
// FROM
//     anticipos
//     INNER JOIN
//     inmuebles
//     ON 
//         anticipos.unid_id = inmuebles.id
//     INNER JOIN
//     conceptservices
//     ON 
//         anticipos.conceptserv_id = conceptservices.id
  return
anticipo:: select(
    'anticipos.id',     
    'anticipos.fechareg', 
    'inmuebles.ident', 
    'inmuebles.nombre', 
    'conceptservices.cve', 
    'conceptservices.shortname', 
    'anticipos.cobertura', 
    'anticipos.observ', 
    'anticipos.folio', 
    'anticipos.status', 
    'anticipos.userreg', 
    'anticipos.desc', 
    'anticipos.docto',
    'anticipos.montoini', 
    'anticipos.saldo',
    'anticipos.condom_id'
        )
->join("inmuebles", "anticipos.unid_id", "=",  "inmuebles.id") 
->join("conceptservices", "anticipos.conceptserv_id", "=",  "conceptservices.id") 
->where("anticipos.condom_id",$condomid)        
->orderBy("anticipos.fechareg")              
->paginate(10)       
        ;        
}

}
