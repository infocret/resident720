<?php

namespace App\Repositories;

use App\Models\maillist;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class maillistRepository
 * @package App\Repositories
 * @version October 27, 2018, 12:02 am UTC
 *
 * @method maillist findWithoutFail($id, $columns = ['*'])
 * @method maillist find($id, $columns = ['*'])
 * @method maillist first($columns = ['*'])
*/
class maillistRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'inmueble_id',
        'listtype',
        'email'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return maillist::class;
    }
 //================================================
   // Funcion creada por JB para consultar listas de correos asignadas a las unidades de un condominio
    public function gEmailList($inmuid)  // $id = inmueble_id
    {   
        // SELECT
        // maillists.id,
        // relationship_properties.parent_property,
        // inmuebles.id as unidadid,
        // inmuebles.ident,
        // inmuebles.nombre,
        // maillists.listtype,
        // maillists.email
        // FROM
        // maillists
        // INNER JOIN inmuebles ON maillists.inmueble_id = inmuebles.id
        // INNER JOIN relationship_properties ON relationship_properties.son_property = inmuebles.id
        // and relationship_properties.parent_property = 7
        return 
        maillist::
        join("inmuebles","maillists.inmueble_id","=","inmuebles.id")
        ->join("relationship_properties","relationship_properties.son_property","=","inmuebles.id")
        ->where('relationship_properties.parent_property',$inmuid) 
        ->orderBy('maillists.listtype','ASC')
        ->orderBy('inmuebles.id','ASC')                 
        ->select( 
        'maillists.id as mailistid',     
        'relationship_properties.parent_property as condid',
        'inmuebles.id as unidid',
        'inmuebles.ident as unidcve',
        'inmuebles.nombre as uninom',
        'maillists.listtype as listipo',
        'maillists.email as correo'
        )
        ->get()
        //->toarray()
        ;        
    }     

//Devuelve un array con los correos que estan registrados a una unidad
//y que se usan para una accion especifica - enviar recibos - enviar noticias 
public function gmailto($unidid, $tipo)
{
//SELECT maillists.email FROM maillists WHERE
//maillists.inmueble_id = 71 AND maillists.listtype ='SendReci'
   return maillist::select('maillists.email')
    ->where('maillists.inmueble_id',$unidid)
    ->where('maillists.listtype',$tipo)
    ->get()->toarray();
}


}
